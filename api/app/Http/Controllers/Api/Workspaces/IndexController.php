<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Workspaces;

use App\Http\Resources\WorkspaceResource;
use App\Http\Responses\CollectionResponse;
use App\Services\WorkspaceService;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final readonly class IndexController
{
    public function __construct(
        private AuthManager $auth,
        private WorkspaceService $service,
    ) {}

    public function __invoke(Request $request): Responsable
    {
        return new CollectionResponse(
            data: WorkspaceResource::collection(
                resource: $this->service->all(
                    user: $this->auth->id(),
                ),
            ),
        );
    }
}
