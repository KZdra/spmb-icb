<?php

namespace App\Mail;

use App\Models\PengaturanAplikasi;
use App\Models\Siswa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengumumanKelulusanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $siswa;
    public $setting;

    /**
     * Create a new message instance.
     */
    public function __construct(Siswa $siswa)
    {
        $this->siswa = $siswa;
        $this->setting = PengaturanAplikasi::first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $school = $this->setting->app_name ?? 'SMK ICB Cinta Teknika';
        return new Envelope(
            subject: "[SPMB {$school}] Surat Keputusan Kelulusan & Penetapan NIS Siswa Baru",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.kelulusan',
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
