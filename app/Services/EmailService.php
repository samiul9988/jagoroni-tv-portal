<?php

namespace App\Services;

use App\Mail\{ArticleSubscription, CommentSubscription};
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class EmailService
{    
    /**
     * sendPostSubcription
     *
     * @param  mixed $post
     * @return void
     */
    public function sendPostSubcription($post)
    {
        $subscribers = Subscriber::whereIn('status', ['active'])->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new ArticleSubscription($post, $subscriber->email));
        }
    }

    public function sendCommentReplySubcription($post, $comment, $responder)
    {
        Mail::to($comment->email)->send(new CommentSubscription($post, $comment, $responder, $comment->email));
    }

}
