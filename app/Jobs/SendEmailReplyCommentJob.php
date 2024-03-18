<?php

namespace App\Jobs;

use App\Mail\CommentSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailReplyCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post, $comment, $responder;

    /**
     * Create a new job instance.
     */
    public function __construct($post, $comment, $responder)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->responder = $responder;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->comment->email)->send(new CommentSubscription($this->post, $this->comment, $this->responder));
    }
}
