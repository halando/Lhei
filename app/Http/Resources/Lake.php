<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class t extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            "username"=>$this->username,
            "fullname"=>$this->fullname,
            "email"=>$this->email,
            "tagsbegin"=>$this->tagsbegin,
            "permission"=>$this->permission
        ];
    }
}
