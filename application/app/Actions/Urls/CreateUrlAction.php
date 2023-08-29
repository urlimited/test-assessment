<?php

namespace App\Actions\Urls;

use App\Contracts\ActionContract;
use App\Contracts\DataTransferObjectContract;
use App\DTO\CreateUrlDTO;
use App\Models\Url;

class CreateUrlAction implements ActionContract
{
    protected GenerateSlugAction $slugHandler;

    public function __construct(GenerateSlugAction $slugHandler)
    {
        $this->slugHandler = $slugHandler;
    }

    public function handle(DataTransferObjectContract|CreateUrlDTO $dto = null)
    {
        $slug = $this->slugHandler->handle();

        Url::query()
            ->create(
                [
                    ...$dto->toArray(),
                    'slug' => $slug,
                ]
            );
    }
}
