<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\NewWorkspace;
use App\Models\Workspace;
use App\Models\WorkspaceMember;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final readonly class WorkspaceService
{
    public function __construct(
        private DatabaseManager $database,
    ) {}

    public function all(string $user): Collection
    {
        return $this->query()->where(
            column: 'user_id',
            operator: '=',
            value: $user
        )->get();
    }

    public function create(string $user, NewWorkspace $payload): Workspace
    {
        return $this->database->transaction(
            callback: fn () => $this->query()->create(
                attributes: array_merge(
                    $payload->toArray(),
                    ['user_id' => $user],
                ),
            ),
            attempts: 3,
        );
    }

    public function addMember(string $user, string $workspace): WorkspaceMember|Model
    {
        return $this->database->transaction(
            callback: fn () => WorkspaceMember::query()->create([
                'user_id' => $user,
                'workspace_id' => $workspace,
            ]),
        );
    }

    protected function query(): Builder
    {
        return Workspace::query();
    }
}
