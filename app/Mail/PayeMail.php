<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
  public $number;
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payement publicité chez EUREKA',
        );
    }

    /**a
     * Get the message content definition.
     */
    // public function content($number): Content
    // {
    //     return new Content(
    //         view('payement')->with(['number'=>$number])
    //     );
    // }
    public function build()
    {
        return $this->view('payement')->with(['number' => $this->number]);
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
