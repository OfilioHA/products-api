<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->person->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->person->phone,
            'photo' => $this->person->photo,
            'gender' => $this->person->photo,
            'roles' => $this->roles->pluck('name')[0]
        ];
    }
}
