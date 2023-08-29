<?php

namespace App\Http\Requests;

use App\Contracts\DataTransferObjectContract;
use App\Contracts\DTOTransferableContract;
use App\DTO\CreateUrlDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreUrlRequest extends FormRequest implements DTOTransferableContract
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array>
     */
    public function rules(): array
    {
        return [
            'destination' => ['required', 'string', 'active_url', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'destination.max' => 'An original URL is too long, please make it shorter',
            'destination.active_url' => 'An original URL does not seem to be active, please check it',
        ];
    }

    public function toDTO(): DataTransferObjectContract|CreateUrlDTO
    {
        return new CreateUrlDTO(
            destination: $this->get('destination')
        );
    }
}
