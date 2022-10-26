<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    // public function before($model, $ability)
    // {
    //     if (request()->user('admin')->role == 'admin') {
    //         return true;
    //     }
    // }

    public function isOga()
    {
        if (request()->user('admin')->role == 'super_admin') {
            return true;
        }
    }
}