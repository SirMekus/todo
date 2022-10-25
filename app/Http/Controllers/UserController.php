<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
        return view('admin.users', [
            'activities'=>User::paginate()
        ]);
    }
}
