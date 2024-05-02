<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Avatar\Variant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = User::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'avatar' => \sprintf(
                "%s/%s/%s/%s?colors=%s&%s",
                'https://source.boringavatars.com',
                $this->faker->randomElement(Variant::cases())->value,
                200,
                $name,
                implode(',',['#45B39D', '#F1948A', '#FDAC4B', '#0E0239', '#FFF9F5']),
                $this->faker->boolean(),
            ),
            'current_workspace_id' => null,
            'email_verified_at' => now(),
        ];
    }
}
