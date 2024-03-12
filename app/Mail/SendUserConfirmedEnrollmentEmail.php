<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendUserConfirmedEnrollmentEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $enrollment;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $enrollment)
    {
        $this->user = $user;
        $this->enrollment = $enrollment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Sua inscrição foi concluída',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        return new Content(
            markdown: 'enrollment',
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

    public function build()
    {
        return $this
            ->markdown('enrollment')->with(['user' => $this->user, 'enrollment' => $this->enrollment]);
    }
}
