<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Appoint;


class AppointUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $appoint;
    public $appoint_info;
    public $appoint_user;

    /**
     * Create a new message instance.
     */
    public function __construct(Appoint $appoint,$appoint_info,$appoint_user)
    {
        //
        $this->appoint = $appoint;
        $this->appoint_info = $appoint_info;
        $this->appoint_user = $appoint_user;


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '予約が完了しました',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.to_user.shipped',
            with:[
                'appoint_info' => $this->appoint_info,
                'appoint_user' => $this->appoint_user,
            ]
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
