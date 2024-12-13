<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $files;

    /**
     * Create a new message instance.
     *
     * @param string $messageContent
     * @param array $files
     */
    public function __construct($messageContent, $files)
    {
        $this->messageContent = $messageContent;
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('Chef Application')
            ->html("<p>{$this->messageContent}</p>");
    
        // Attach files if provided
        foreach ($this->files as $file) {
            $email->attach($file->getRealPath(), [
                'as' => $file->getClientOriginalName(),
                'mime' => $file->getMimeType(),
            ]);
        }
    
        return $email;
    }
    
}
