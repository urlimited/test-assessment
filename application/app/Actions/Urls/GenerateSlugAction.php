<?php

namespace App\Actions\Urls;

use App\Contracts\ActionContract;
use App\Contracts\DataTransferObjectContract;
use App\DTO\CreateUrlDTO;

class GenerateSlugAction implements ActionContract
{

    public function handle(DataTransferObjectContract|CreateUrlDTO $dto = null): string
    {
        $charset = config('url_shortening.url_charset');

        $base = strlen($charset);

        $result = '';

        $now = explode(' ', microtime())[1];

        while ($now >= $base){
            $i = $now % $base;
            $result = $charset[$i] . $result;
            $now /= $base;
        }

        return substr($result, -1 * config('url_shortening.url_length'));
    }
}
