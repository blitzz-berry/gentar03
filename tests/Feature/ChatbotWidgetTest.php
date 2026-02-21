<?php

namespace Tests\Feature;

use App\Livewire\ChatbotWidget;
use Livewire\Livewire;
use Tests\TestCase;

class ChatbotWidgetTest extends TestCase
{
    public function test_initial_state_has_greeting_and_idle_state(): void
    {
        Livewire::test(ChatbotWidget::class)
            ->assertSet('chatState', 'idle')
            ->assertSee('Halo, aku Si Panitia Santuy.')
            ->assertSee('Daftar Lomba')
            ->assertSee('Lihat Jadwal');
    }

    public function test_daftar_lomba_moves_state_to_ask_age(): void
    {
        Livewire::test(ChatbotWidget::class)
            ->call('useQuickReply', 'Daftar Lomba')
            ->assertSet('chatState', 'ask_age')
            ->assertSee('Ini daftar lomba yang lagi dibuka')
            ->assertSee('Kasih tau umur dulu, nanti aku sortir yang cocok.');
    }

    public function test_invalid_age_is_rejected(): void
    {
        Livewire::test(ChatbotWidget::class)
            ->call('useQuickReply', 'Daftar Lomba')
            ->set('newMessage', 'umur 99')
            ->call('sendMessage')
            ->assertSet('chatState', 'ask_age')
            ->assertSee('Kayaknya umur itu nggak masuk akal deh.');
    }

    public function test_full_quota_lomba_shows_alternative_message(): void
    {
        Livewire::test(ChatbotWidget::class)
            ->call('useQuickReply', 'Daftar Lomba')
            ->set('newMessage', '20')
            ->call('sendMessage')
            ->assertSet('chatState', 'ask_pick_lomba')
            ->call('useQuickReply', 'Tarik Tambang Umum')
            ->assertSet('chatState', 'ask_pick_lomba')
            ->assertSee('Waduh, yang ini udah full 20/20.')
            ->assertSee('masih ada opsi lain kok.');
    }

    public function test_incomplete_registration_data_is_rejected(): void
    {
        Livewire::test(ChatbotWidget::class)
            ->call('useQuickReply', 'Daftar Lomba')
            ->set('newMessage', '12')
            ->call('sendMessage')
            ->assertSet('chatState', 'ask_pick_lomba')
            ->call('useQuickReply', 'Estafet Ceria Anak')
            ->assertSet('chatState', 'collect_form')
            ->set('newMessage', 'Budi, Ibu Ani')
            ->call('sendMessage')
            ->assertSet('chatState', 'collect_form')
            ->assertSee('Datanya belum lengkap nih.');
    }

    public function test_registration_success_shows_required_rules_and_success_state(): void
    {
        Livewire::test(ChatbotWidget::class)
            ->call('useQuickReply', 'Daftar Lomba')
            ->set('newMessage', '12')
            ->call('sendMessage')
            ->call('useQuickReply', 'Estafet Ceria Anak')
            ->set('newMessage', 'Budi Santoso, Ibu Ani, 081234567890')
            ->call('sendMessage')
            ->assertSet('chatState', 'confirm_form')
            ->call('useQuickReply', 'Ya, Daftarkan')
            ->assertSet('chatState', 'success_done')
            ->assertSee('Resmi terdaftar! Calon juara RW nih.')
            ->assertSee('Datang minimal 5 menit sebelum mulai ya.')
            ->assertSee('Kalau sampai dipanggil 3x nggak ada, panitia terpaksa coret.');
    }
}
