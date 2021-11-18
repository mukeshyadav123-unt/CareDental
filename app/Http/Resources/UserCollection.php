<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class UserCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->prepare(),
        ];
    }

    protected function prepare()
    {
        return $this->collection->groupBy('type');
    }
}
