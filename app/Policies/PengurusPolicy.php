<?php

namespace App\Policies;

use App\Models\Pengurus;
use App\Models\User;

class PengurusPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Pengurus $pengurus): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Pengurus $pengurus): bool
    {
        return true;
    }

    public function delete(User $user, Pengurus $pengurus): bool
    {
        return true;
    }
}

