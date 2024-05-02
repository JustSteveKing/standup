<?php

declare(strict_types=1);

namespace App\Jobs\Workspaces;

use App\Models\User;
use App\Services\WorkspaceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class AddMemberToWorkspace implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $user,
        public readonly string $workspace,
    ) {}

    public function handle(WorkspaceService $service): void
    {
        $service->addMember(
            user: $this->user,
            workspace: $this->workspace,
        );

        User::query()->where('id', $this->user)->update([
            'current_workspace_id' => $this->workspace
        ]);
    }
}
