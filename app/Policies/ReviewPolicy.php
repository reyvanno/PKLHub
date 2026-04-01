<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * User boleh membuat review jika sudah login
     */
    public function create(User $user): bool
    {
        return $user->role === 'user';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * User hanya boleh menghapus reviewnya sendiri
     */
    public function delete(User $user, Review $review): bool
    {
        if ($user->role === 'admin') {
            return true; // Admin bisa menghapus semua review
        }

        return $review->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Review $review): bool
    {
        return false;
    }
}
