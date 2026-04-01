<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function view(User $user, Company $company): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    public function update(User $user, Company $company): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $company->owner_id === $user->id;
    }

    public function delete(User $user, Company $company): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $company->owner_id === $user->id;
    }
}