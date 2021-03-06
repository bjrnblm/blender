<?php

namespace App\Events;

use App\Models\User;

class UserWasActivated extends Event
{
    /**
     * @var \App\Models\User
     */
    public $user;

    /**
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
