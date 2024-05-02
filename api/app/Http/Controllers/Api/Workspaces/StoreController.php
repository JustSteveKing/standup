<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Workspaces;

use App\Http\Requests\Api\Workspaces\StoreRequest;
use App\Http\Responses\MessageResponse;
use App\Jobs\Workspaces\CreateNewWorkspace;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class StoreController
{
    public function __construct(
        private Dispatcher $bus,
        private AuthManager $auth,
    ) {}

    public function __invoke(StoreRequest $request): Responsable

    {
        $this->bus->dispatch(
            command: new CreateNewWorkspace(
                user: $this->auth->id(),
                payload: $request->payload(),
            ),
        );

        return new MessageResponse(
            data: 'We are processing your request.',
            status: Status::ACCEPTED,
        );
    }
}
