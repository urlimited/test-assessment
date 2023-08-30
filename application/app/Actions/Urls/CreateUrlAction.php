<?php

namespace App\Actions\Urls;

use App\Contracts\ActionContract;
use App\Contracts\DataTransferObjectContract;
use App\DTO\CreateUrlDTO;
use App\Models\Url;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CreateUrlAction implements ActionContract
{
    protected GenerateSlugAction $slugHandler;

    public function __construct(GenerateSlugAction $slugHandler)
    {
        $this->slugHandler = $slugHandler;
    }

    /**
     * @throws ValidationException
     */
    public function handle(DataTransferObjectContract|CreateUrlDTO $dto = null): Url
    {
        // Sometimes there might be collisions
        $tries = config('url_shortening.number_of_tries');

        $currentTry = 1;

        $isCreated = false;

        // We could handle collisions by several random tries
        while ($currentTry <= $tries) {
            try {
                $slug = $this->slugHandler->handle();

                /** @var Url $url */
                $url = Url::query()
                    ->create(
                        [
                            ...$dto->toArray(),
                            'slug' => $slug,
                        ]
                    );

                $isCreated = true;

                break;
            } catch (Exception) {
                $currentTry++;
            }
        }

        // If we could not create the URL with unique slug, we should throw validation exception
        if (!$isCreated) {
            throw ValidationException::withMessages(
                ['There are too many collisions, please try again later']
            );
        }

        // At this moment $url will be definitely exist, if not, it must be thrown at the lines above
        return $url;
    }
}
