<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $member;
    public $data;
    public $filePath;

    public function __construct($user, $member, $data, $filePath = null)
    {
        $this->user = $user;
        $this->member = $member;
        $this->data = $data;
        $this->filePath = $filePath;
    }

    public function build()
    {
        $mail = $this->subject('New Comment Submitted')
                     ->view('email.add-comment');

        if ($this->filePath && file_exists(storage_path('app/public/' . $this->filePath))) {
            $mail->attach(storage_path('app/public/' . $this->filePath));
        }

        return $mail;
    }
}
