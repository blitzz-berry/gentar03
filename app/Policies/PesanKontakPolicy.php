<?php

namespace App\Policies;

use App\Models\PesanKontak;
use App\Models\User;

class PesanKontakPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PesanKontak $pesanKontak): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, PesanKontak $pesanKontak): bool
    {
        return true;
    }

    public function delete(User $user, PesanKontak $pesanKontak): bool
    {
        return true;
    }
}

