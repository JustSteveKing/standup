<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Workspaces;

use App\Http\Payloads\NewWorkspace;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','string','min:2','max:255'],
            'color' => ['nullable','string','min:2','max:255'],
            'logo' => ['nullable','string','url','min:2','max:255'],
            'description' => ['nullable','string','min:2','max:255'],
        ];
    }

    public function payload(): NewWorkspace
    {
        return new NewWorkspace(
            name: $this->string('name')->toString(),
            color: $this->has('color')
                ? $this->string('color')->toString()
                : null,
            logo: $this->has('logo')
                ? $this->string('logo')->toString()
                : null,
            description: $this->has('description')
                ? $this->string('description')->toString()
                : null,
        );
    }
}
