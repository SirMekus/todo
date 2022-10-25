<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Str;

class SpecialAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(
            ['name' => [
                'firstname' => "Emeka",
                'lastname' => "Ohakwe",
            ],
            'role' => 'super_admin',  'email' => "mekus600@gmail.com",
            'password' => 'password',
            'remember_token' => Str::random(10),
            ]
        );
    }
}
