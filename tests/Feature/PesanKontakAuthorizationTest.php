<?php

namespace Tests\Feature;

use App\Models\PesanKontak;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesanKontakAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_pesan_kontak_index_requires_authentication(): void
    {
        $this->get(route('pesan-kontak.index', [], false))
            ->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_pesan_kontak_index(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('pesan-kontak.index', [], false))
            ->assertOk();
    }

    public function test_authenticated_user_can_access_pesan_kontak_show(): void
    {
        $user = User::factory()->create();
        $pesan = PesanKontak::create([
            'nama' => 'Pengunjung',
            'email' => 'pengunjung@example.com',
            'subjek' => 'Halo',
            'pesan' => 'Isi pesan',
        ]);

        $this->actingAs($user)
            ->get(route('pesan-kontak.show', $pesan, false))
            ->assertOk();
    }
}
