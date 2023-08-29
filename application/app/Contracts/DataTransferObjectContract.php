<?php

namespace App\Contracts;

abstract class DataTransferObjectContract
{
    public abstract function toArray(): array;
}
