<?php

namespace App\DTO;

use App\Contracts\DataTransferObjectContract;
use JetBrains\PhpStorm\ArrayShape;

class CreateUrlDTO extends DataTransferObjectContract
{

    public function __construct(
        public readonly string $destination,
    )
    {
    }

    #[ArrayShape([
        'destination' => 'string'
    ])]
    public function toArray(): array
    {
        return [
            'destination' => $this->destination,
        ];
    }
}
