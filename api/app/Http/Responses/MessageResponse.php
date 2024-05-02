<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Http\Factories\HeaderFactory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use JustSteveKing\Tools\Http\Enums\Status;
use Symfony\Component\HttpFoundation\Response;

final readonly class MessageResponse implements Responsable
{
    public function __construct(
        private string $data,
        private Status $status = Status::OK,
    ) {}

    public function toResponse($request): Response
    {
        return new JsonResponse(
            data: [
                'message' => $this->data,
            ],
            status: $this->status->value,
            headers: HeaderFactory::default(),
        );
    }
}
