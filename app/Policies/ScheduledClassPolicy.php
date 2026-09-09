<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;

class ScheduledClassPolicy
{
    public function delete(User $user, ScheduledClass $scheduled)
    {
        if ($user->role == 'admin') {
            return true;
        }
        return $user->id === $scheduled->instructor_id;
    }
}
