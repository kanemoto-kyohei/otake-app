<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NewUserIntroduction extends Mailable
{
    use Queueable, SerializesModels;

    public $subject  = '新しいユーザが追加されました！';
    public User $toUser;
    public User $newUser;

    /**
     * Create a new message instance.
     */

    public function __construct(User $toUser,User $newUser)
    {
        //
        $this->toUser = $toUser;
        $this->newUser = $newUser;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '新しいユーザが追加されました',
        );
    }

    /**
     * Get the message content definition.
     */
    //自作のblade.phpの中のメッセージを表示させたかったらここを使う
    public function content(): Content
    {
        return new Content(
            view: 'email.new_user_introduction',
        );
    }

    //このメソッドを使ってメールをHTML形式にしている
    public function build()
    {
        return $this->markdown('email.new_user_introduction')
                ->with([
                    $toUser = $this->toUser,
                    $newUser = $this->newUser
                ]);
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
