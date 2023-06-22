<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user):bool
    {
        return $user->user_type == 'A';
    }

}
