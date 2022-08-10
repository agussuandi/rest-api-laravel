<?php

namespace App\Http\Resources\User;

use App\Http\Resources\InitResource;

class UserResource extends InitResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}