<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->dateTime,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'head_logo' => '',
            'avatar' => '',
            'user_ip' => $this->faker->ipv4,
            'user_type' => $this->faker->numberBetween(0, 1),
            'activity_token' => '111',
            'activity_expire' => $this->faker->dateTime,
            'is_activity' => $this->faker->numberBetween(0, 1),
            'storage_1' => '',
            'storage_2' => '',
            'storage_3' => '',
            'remember_token' => '222',
        ];
    }
}
