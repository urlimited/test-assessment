<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "destination" => $this->resource->destination,
            "slug" => $this->resource->slug,
            "updated_at" => $this->resource->updated_at,
            "created_at" => $this->resource->created_at,
            "id" => $this->resource->id,
            "shortened_url" => $this->resource->full_url
        ];
    }
}
