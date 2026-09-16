<?php

namespace App\Http\Controllers;

use App\Models\{Comment, Post, User};
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailReplyCommentJob;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{    
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    } 
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'sometimes|required',
            'email' => 'sometimes|required|email',
            'url' => 'nullable|url:http, https',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            $resp = ['errors' => $validator->errors()];
            return response()->json($resp);
        }

        if ($request->mainReply) {
            $checkCommentRepyExists = Comment::find($request->mainReply);

            if (!$checkCommentRepyExists) {
                $resp = ['errors' => ['comment_exists' => __('message.comments_could_not_be_found')]];
                return response()->json($resp);
            }
        }

        $user = User::where('email', $request->email);

        if($user->exists()) {
            $user = $user->first();
            $isUser = true;
        } else {
            if ($request->has('userid')) {
                $user = User::find($request->userid);
                $isUser = true;
            } else {
                $isUser = false;
            }
        }

        if ($isUser) {
            $name = $user->name;
            $avatar = $user->photo;
            $email = $user->email;
            $url = '';
            $userid = $user->id;
        } else {
            $name = $request->name;
            $avatar = '';
            $email = $request->email;
            $url = $request->url;
            $userid = 0;
        }

        if ($userid > 0) {
            $status = 'approved';
        } else {
            $status = config('settings.comment_approval') == 'y' ? 'pending' : 'approved';
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'url' => $url,
            'comment' => $request->comment,
            'avatar' => $avatar,
            'reply_id' => $request->replyId ?: 0,
            'main_reply' => $request->mainReply ?: 0,
            'user_id' => $userid,
            'post_id' => $request->postId,
            'status' => $status
        ];

        $comment = Comment::create($data);

        $count = Comment::where('post_id', $request->postId)->where('status', 'approved')->count();

        // update comment count
        $post = Post::find($request->postId);
        $post->comment_count = $post->comment_count + 1;
        $post->save();

        if ($comment) {
            $data = [
                'id'       => $comment->id,
                'name'     => $comment->name,
                'image'    => $avatar ?  asset('storage/avatar/' . $avatar) : asset('img/noavatar.png'),
                'date'     => Carbon::parse($comment->created_at)->ago(),
                'comment'  => $comment->comment,
                'reply_id' => (int) $comment->reply_id,
                'user_id'  => $comment->user_id,
                'status'   => $comment->status,
                'count'    => $count .' '. __('jagoronitv::magz.response')
            ];

            $depth = $comment->getDepth();

            $isReply = $depth < (int) config('settings.number_nested_comments') ? true : false;

            $response = [
                'data' => $data,
                'action' => [
                    'reply' => __('jagoronitv::magz.reply'),
                    'edit' => __('jagoronitv::magz.edit'),
                    'delete' => __('jagoronitv::magz.delete'),
                ],
                'messageModeration' => __('jagoronitv::magz.message_pending'),
                'isReply' => $isReply,
                'status' => true,
                'message' => __('message.comment_has_been_sent')
            ];

            if (config('settings.send_comment_reply_email') == 'y') {
                if (env('MAIL_USERNAME')) {
                    if ($request->filled('replyId')) {
                        $sendEmail = Comment::find($request->replyId);

                        if ($sendEmail->subscribe == 'y') {
                            $post = Post::find($request->postId);
                            dispatch(new SendEmailReplyCommentJob($post, $sendEmail, $comment));
                        }
                    }
                }
            }
            
            return response()->json(['success' => $response]);
        } else {
            return response()->json(['failed' => [
                'data' => '',
                'status' => false,
                'message' => __('message.comment_could_not_be_sent')
            ]]);
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return response()->json($comment);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            $resp = ['errors' => $validator->errors()];
            return response()->json($resp);
        }

        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->save();

        $response = [
            'data' => $comment,
            'action' => [
                'reply' => __('jagoronitv::magz.reply'),
                'edit' => __('jagoronitv::magz.edit'),
                'delete' => __('jagoronitv::magz.delete'),
            ],
            'message' => __('message.updated_successfully')
        ];

        return response()->json(['success' => $response]);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        //checking reply
        if (Comment::where('main_reply', $comment->id)->exists()) {
            
            //count
            $count = Comment::where('main_reply', $comment->id)->count();

            // update comment count
            $post = Post::find($comment->post_id);
            $post->comment_count = $post->comment_count - $count;
            $post->save();

            //delete reply
            Comment::where('main_reply', $comment->id)->delete();
        }

        // update comment count
        $post = Post::find($comment->post_id);
        $post->comment_count = $post->comment_count - 1;
        $post->save();

        //delete
        $comment->delete();

        //count response
        $count = Comment::where('status', 'approved')->count();

        return response()->json([
            'success' => __('message.deleted_successfully'),
            'count' => $count .' '. __('jagoronitv::magz.response')
        ]);
    }
}
