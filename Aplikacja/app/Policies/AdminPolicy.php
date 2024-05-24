<?php

// app/Policies/AdminPolicy.php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can access the admin panel.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function access(User $user)
    {
        return $user->permission == 1;
    }
}
