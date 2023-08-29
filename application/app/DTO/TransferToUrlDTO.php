<?php

namespace App\DTO;

use App\Contracts\DataTransferObjectContract;
use App\Models\Url;
use JetBrains\PhpStorm\ArrayShape;

class TransferToUrlDTO extends DataTransferObjectContract
{

    public function __construct(
        public readonly Url $url,
    )
    {
    }

    #[ArrayShape([
        'url' => Url::class
    ])]
    public function toArray(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
