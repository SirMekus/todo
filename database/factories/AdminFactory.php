<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => [
                'firstname'=>$this->faker->firstName,
                'lastname'=>$this->faker->lastName
            ],
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }
}
