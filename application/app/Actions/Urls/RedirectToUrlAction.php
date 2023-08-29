<?php

namespace App\Actions\Urls;

use App\Contracts\ActionContract;
use App\Contracts\DataTransferObjectContract;
use App\DTO\TransferToUrlDTO;

class RedirectToUrlAction implements ActionContract
{
    public function handle(DataTransferObjectContract|TransferToUrlDTO $dto = null): string
    {
        $dto->url
            ->update(
                [
                    'views' => $dto->url->getAttribute('views') + 1
                ]
            );

        return $dto->url->getAttribute('destination');
    }
}
