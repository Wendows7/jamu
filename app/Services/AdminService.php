<?php

namespace App\Services;

use App\Models\User;

class AdminService
{
    protected $user;

    public function __construct(User $userService)
    {
        $this->user = $userService;
    }

    public function showMinute()
    {

        $request = session()->get('waktuLogin');
        $waktuLogin = $request;
        $selisihMenit = $waktuLogin->diffForHumans();

        return $selisihMenit;
    }

    public function getAllUser()
    {
        return $this->user->latest()->paginate(10);
    }
}
