<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\Workspace;
use App\Models\WorkspaceMember;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class WorkspaceMemberFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = WorkspaceMember::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'workspace_id' => Workspace::factory(),
        ];
    }
}
