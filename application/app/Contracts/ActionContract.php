<?php

namespace App\Contracts;

interface ActionContract
{
    public function handle(DataTransferObjectContract $dto = null);
}
