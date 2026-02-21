<?php

namespace App\Mail;

use App\Models\PesanKontak;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PesanBalasanMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PesanKontak $pesanKontak,
        public string $pesanBalasan
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Balasan: ' . $this->pesanKontak->subjek
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pesan-balasan',
        );
    }
}

