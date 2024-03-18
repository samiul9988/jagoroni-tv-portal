<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CommentDataTable;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailReplyCommentJob;
use App\Models\{Comment, Post};
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Gate, Validator};

class CommentController extends Controller
{   
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;

        $this->middleware('permission:read-comments', ['only' => ['index']]);
        $this->middleware('permission:add-comments', ['only' => ['store']]);
        $this->middleware('permission:update-comments', ['only' => ['update', 'updateStatus']]);
        $this->middleware('permission:reply-comments', ['only' => ['store']]);
    } 

    /**
     * index
     *
     * @param  mixed $dataTable
     * @return void
     */
    public function index(CommentDataTable $dataTable)
    {
        return $dataTable->render('admin.comments.index');
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
            'name'    => 'sometimes|required',
            'email'   => 'sometimes|required|email',
            'url'     => 'nullable|url:http, https',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            $resp = ['errors' => $validator->errors()];
            return response()->json($resp);
        }

        $user = Auth::user();

        $comment = Comment::create([
            'name'       => $user->name,
            'email'      => $user->email,
            'url'        => '',
            'comment'    => $request->comment,
            'avatar'     => $user->photo,
            'reply_id'   => $request->replyId,
            'main_reply' => $request->mainReply,
            'user_id'    => $user->id,
            'post_id'    => $request->postId,
            'status'     => 'approved'
        ]);

        if (config('settings.send_comment_reply_email') == 'y') {
            if (env('MAIL_USERNAME')) {
                $sendEmail = Comment::find($request->replyId);
    
                if ($sendEmail->subscribe == 'y') {
                    $post = Post::find($request->postId);
                    dispatch(new SendEmailReplyCommentJob($post, $sendEmail, $comment));
                }
            }
        }

        // update comment count
        $post = Post::find($request->postId);
        $post->comment_count = $post->comment_count + 1;
        $post->save();

        return response()->json(['success' => __('message.saved_successfully')]); 
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

        return response()->json(['success' => __('message.updated_successfully')]);
    }
    
    /**
     * updateStatus
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateStatus(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->status = $request->status;
        $comment->save();

        $msg = $request->status === 'approved' ?
            __('message.comment_successfully_approved') : __('message.approved_comments_cancelled');

        return response()->json(['success' => $msg]);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-comments')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

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

        //delete comment
        $comment->delete();

        // update comment count
        $post = Post::find($comment->post_id);
        $post->comment_count = $post->comment_count - 1;
        $post->save();

        return response()->json(['success' => __('message.deleted_successfully')]);
    }
    
    /**
     * massdestroy
     *
     * @return void
     */
    public function massdestroy()
    {
        if (! Gate::allows('delete-comments')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $comment_id_array = request('id');

        $comments = Comment::whereIn('id', $comment_id_array);

        foreach($comments->get() as $comment){
            //checking reply
            if (Comment::where('main_reply', $comment->id)->exists()) {
                //count
                $count = Comment::where('main_reply', $comment->id)->count();

                if ($count > 0) {
                    // update comment count
                    $post = Post::find($comment->post_id);
                    $post->comment_count = $post->comment_count - $count;
                    $post->save();

                    //delete reply
                    Comment::where('main_reply', $comment->id)->delete();
                }
            }

            // update comment count
            $post = Post::find($comment->post_id);
            if ($post->comment_count > 0) {
                $post->comment_count = $post->comment_count - 1;
                $post->save();
            }
        }

        if($comments->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }
}
