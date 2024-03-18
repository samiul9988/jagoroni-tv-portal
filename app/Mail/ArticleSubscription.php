<?php

namespace App\Mail;

use App\Models\Post;
use App\Helpers\PostHelper;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleSubscription extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Post $post, public $email)
    {
        $this->post = $post;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Article Subscription',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.article.subscription',
            with: [
                'title' => $this->post->post_title,
                'img' => $this->post->post_image,
                'content' => Str::limit(strip_tags($this->post->post_content), 100),
                'url' => PostHelper::getUriPost($this->post),
                'button_article_subscribe' => __('mail.button_article_subscribe'),
                'closing_article_subscribe' => __('mail.closing_article_subscribe', ['name' => config('settings.site_name'), 'url' => url('unsubscrib/verify/'.$this->email)])
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
