<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Workspace $resource
 */
final class WorkspaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'color' => $this->resource->color,
            'logo' => $this->resource->logo,
            'description' => $this->resource->description,
            'owner' => new UserResource(
                resource: $this->whenLoaded(
                    relationship: 'owner',
                ),
            ),
            'created' => new DateResource(
                resource: $this->resource->created_at,
            ),
        ];
    }
}
