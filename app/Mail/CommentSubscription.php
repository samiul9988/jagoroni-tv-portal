<?php

namespace App\Mail;

use App\Models\{Post, Comment};
use App\Helpers\PostHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Crypt;

class CommentSubscription extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Post $post, public Comment $comment, public Comment $responder)
    {
        $this->post      = $post;
        $this->comment   = $comment;
        $this->responder = $responder;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('mail.subject_comment_subscribe', ['site_name' => config('settings.site_name')]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.comment.reply',
            with: [
                'opening_comment_subscibe' => __('mail.opening_comment_subscibe', ['post_title' => $this->post->post_title]),
                'comment'                  => $this->responder->comment,
                'comment_url'              => PostHelper::getUriPost($this->post) .'#'. $this->responder->id,
                'note_comment_subscribe'   => __('mail.note_comment_subscribe', [
                    'site_url'   => config('settings.site_url')
                ]),
                'comment_unsubscribe_url' => url('comment/unsubscrib/verify/'.Crypt::encryptString($this->comment->id)),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
