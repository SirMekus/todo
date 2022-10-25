<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Sequence;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->times(3)->state(new Sequence(
            ['role' => 'super_admin'],
            ['role' => 'regular'],
        ))->create();
    }
}
