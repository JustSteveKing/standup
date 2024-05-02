<?php

declare(strict_types=1);

namespace App\Http\Payloads;

final readonly class NewWorkspace
{
    /**
     * @param string $name
     * @param string $color
     * @param string|null $logo
     * @param string|null $description
     */
    public function __construct(
        private string $name,
        private string $color,
        private null|string $logo,
        private null|string $description,
    ) {}

    /**
     * @return array{
     *     name:string,
     *     color:string,
     *     logo:null|string,
     *     description:null|string,
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'color' => $this->color,
            'logo' => $this->logo,
            'description' => $this->description,
        ];
    }

    /**
     * @param array{
     *     name:string,
     *     color:string,
     *     logo:null|string,
     *     description:null|string,
     * } $data
     * @return NewWorkspace
     */
    public static function make(array $data): NewWorkspace
    {
        return new NewWorkspace(
            name: $data['name'],
            color: $data['color'],
            logo: $data['logo'],
            description: $data['description'],
        );
    }
}
