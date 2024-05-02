<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class WorkspaceFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Workspace::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'color' => $this->faker->colorName(),
            'logo' => $this->faker->imageUrl(),
            'description' => $this->faker->realText(),
            'user_id' => User::factory(),
        ];
    }
}
