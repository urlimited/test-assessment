<?php

namespace App\Contracts;

interface DTOTransferableContract
{
    public function toDTO(): DataTransferObjectContract;
}
