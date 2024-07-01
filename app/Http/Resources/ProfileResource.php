<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'user'=> new UserResource($this->user),
            "profile" => [
                // "id" => $this->id,
                'name'=> $this->name,
                'birthday'=> $this->dob,
                'numberPhone' => $this->numberPhone,
                'address' => $this->address,
            ],
        ];
    }
}
