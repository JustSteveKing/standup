<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\Workspaces\AddMemberToWorkspace;
use App\Models\Workspace;
use Illuminate\Contracts\Bus\Dispatcher;

final readonly class WorkspaceObserver
{
    public function __construct(
        private Dispatcher $bus,
    ) {}

    public function created(Workspace $workspace): void
    {
        $this->bus->dispatch(
            command: new AddMemberToWorkspace(
                user: $workspace->user_id,
                workspace: $workspace->id,
            ),
        );
    }
}
