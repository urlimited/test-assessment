<?php

namespace App\Http\Requests;

use App\Contracts\DataTransferObjectContract;
use App\Contracts\DTOTransferableContract;
use App\DTO\TransferToUrlDTO;
use App\Models\Url;
use Illuminate\Foundation\Http\FormRequest;

class ShowUrlRequest extends FormRequest implements DTOTransferableContract
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function toDTO(): DataTransferObjectContract|TransferToUrlDTO
    {
        /** @var Url $url (due to implicit binding) */
        $url = $this->route('url');

        return new TransferToUrlDTO(
            url: $url
        );
    }
}
