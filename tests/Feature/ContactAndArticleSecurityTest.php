<?php

namespace Tests\Feature;

use App\Mail\PesanBalasanMail;
use App\Livewire\JoinForm;
use App\Models\Artikel;
use App\Models\PesanKontak;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactAndArticleSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_contact_store_ignores_internal_status_fields(): void
    {
        $this->post(route('kontak.store', [], false), [
            'nama' => 'Pengunjung',
            'email' => 'pengunjung@example.com',
            'subjek' => 'Halo',
            'pesan' => 'Isi pesan',
            'dibaca' => 1,
            'dibalas' => 1,
            'tanggal_dibaca' => now()->toDateTimeString(),
            'tanggal_dibalas' => now()->toDateTimeString(),
        ])->assertSessionHas('success');

        $pesan = PesanKontak::first();

        $this->assertNotNull($pesan);
        $this->assertSame('Pengunjung', $pesan->nama);
        $this->assertFalse($pesan->dibaca);
        $this->assertFalse($pesan->dibalas);
        $this->assertNull($pesan->tanggal_dibaca);
        $this->assertNull($pesan->tanggal_dibalas);
    }

    public function test_join_form_submits_message_to_contact_inbox(): void
    {
        Livewire::test(JoinForm::class)
            ->set('name', 'Join User')
            ->set('email', 'join@example.com')
            ->set('phone', '08123456789')
            ->set('message', 'Saya ingin bergabung.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('successMessage', 'Pesan Anda telah berhasil dikirim!');

        $pesan = PesanKontak::where('email', 'join@example.com')->first();

        $this->assertNotNull($pesan);
        $this->assertSame('Form Bergabung Website', $pesan->subjek);
        $this->assertStringContainsString('Saya ingin bergabung.', $pesan->pesan);
        $this->assertStringContainsString('No. Telepon: 08123456789', $pesan->pesan);
    }

    public function test_admin_store_sanitizes_article_content(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.artikel.store', [], false), [
                'judul' => 'Artikel Aman',
                'konten' => '<p onclick="alert(1)">Konten</p><script>alert(1)</script><a href="javascript:alert(1)">Klik</a>',
                'kategori' => 'berita',
                'aktif' => 1,
                'tanggal_publikasi' => now()->toDateString(),
            ])
            ->assertRedirect(route('admin.artikel.index', [], false));

        $artikel = Artikel::first();

        $this->assertNotNull($artikel);
        $this->assertStringNotContainsString('<script', $artikel->konten);
        $this->assertStringNotContainsString('onclick=', $artikel->konten);
        $this->assertStringNotContainsString('javascript:', $artikel->konten);
    }

    public function test_public_article_page_renders_safe_content_accessor(): void
    {
        $artikel = Artikel::create([
            'judul' => 'Artikel Existing',
            'konten' => '<p onclick="alert(1)">Konten Aman</p><script>alert(1)</script><a href="javascript:alert(1)">Link</a>',
            'kategori' => 'berita',
            'aktif' => true,
            'tanggal_publikasi' => now(),
        ]);

        $this->get(route('artikel.show', $artikel, false))
            ->assertOk()
            ->assertSee('Konten Aman')
            ->assertDontSee('onclick=', false)
            ->assertDontSee('href="javascript:', false)
            ->assertDontSee("href='javascript:", false);
    }

    public function test_admin_reply_sends_email_and_updates_message_status(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $pesan = PesanKontak::create([
            'nama' => 'Pengunjung',
            'email' => 'pengunjung@example.com',
            'subjek' => 'Tanya Kegiatan',
            'pesan' => 'Kapan kegiatan berikutnya?',
        ]);

        $this->actingAs($user)
            ->post(route('pesan-kontak.balas', $pesan, false), [
                'pesan_balasan' => 'Terima kasih, kegiatan berikutnya hari Minggu.',
            ])
            ->assertRedirect(route('pesan-kontak.index', [], false))
            ->assertSessionHas('success');

        Mail::assertSent(PesanBalasanMail::class, function (PesanBalasanMail $mail) use ($pesan) {
            return $mail->hasTo($pesan->email)
                && str_contains($mail->pesanBalasan, 'kegiatan berikutnya');
        });

        $pesan->refresh();

        $this->assertTrue($pesan->dibalas);
        $this->assertNotNull($pesan->tanggal_dibalas);
    }
}
