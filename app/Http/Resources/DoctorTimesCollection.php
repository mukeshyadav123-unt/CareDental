<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

/** @see \App\Models\DoctorTimes */
class DoctorTimesCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->parse(),
        ];
    }

    private function parse()
    {
        $d = $this->collection->groupBy(function ($value) {
            return $value->date->toDateString();
        });
        return $d;
    }
}
