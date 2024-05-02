<?php

declare(strict_types=1);

namespace App\Jobs\Workspaces;

use App\Http\Payloads\NewWorkspace;
use App\Services\WorkspaceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CreateNewWorkspace implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $user,
        public readonly NewWorkspace $payload,
    ) {}

    public function handle(WorkspaceService $service): void
    {
        $service->create(
            user: $this->user,
            payload: $this->payload,
        );
    }
}
