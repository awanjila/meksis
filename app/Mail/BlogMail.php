<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $imagePath;
    public $contactName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $imagePath = null, $contactName = 'Subscriber')
    {
        $this->data = $data;
        $this->imagePath = $imagePath;
        $this->contactName = $contactName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->data['name'];
        $fromAddress = config('mail.from.address', 'support@wabestudio.co.ke');
        $fromName = config('mail.from.name', 'Blog System');

        $mail = $this->from($fromAddress, $fromName)
                    ->subject($subject)
                    ->markdown('emails.blogMail')
                    ->with([
                        'data' => $this->data,
                        'contactName' => $this->contactName,
                    ]);

        // Attach the image if a path is provided
        if ($this->imagePath && file_exists($this->imagePath)) {
            $mail->attach($this->imagePath, [
                'as' => 'blog_image.' . pathinfo($this->imagePath, PATHINFO_EXTENSION),
                'mime' => mime_content_type($this->imagePath),
            ]);
        }

        return $mail;
    }
}
