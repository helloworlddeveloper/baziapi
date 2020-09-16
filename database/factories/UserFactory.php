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
            'username' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'user_type' => $this->faker->numberBetween(0, 1),
            'ip' => $this->faker->ipv4,
            'is_activity' => $this->faker->numberBetween(0, 1),
            'activity_token' => '111',
            'email_verified_at' => $this->faker->dateTime,
            'logo' => '',
            'photo' => '',
            'remember_token' => '222',
            'activity_expire' => $this->faker->dateTime,

        ];
    }
}
