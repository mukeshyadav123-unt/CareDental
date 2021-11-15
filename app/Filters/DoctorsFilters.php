<?php

namespace App\Filters;

use App\Filters\Base\Filters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DoctorsFilters extends Filters
{

    protected $filters = ['name', 'specialty', 'address',
        'gender', 'phone_number'];


    protected function name(): Builder
    {
        return $this->builder->Where('name', 'like',
            "%{$this->request->name}%");
    }

    protected function specialty(): Builder
    {
        return  $this->builder->WhereHas('details', fn($q)=> $q->Where('specialty', 'like',
            "%{$this->request->specialty}%"));
    }


    protected function address(): Builder
    {
        return $this->builder->WhereHas('details', fn($q)=> $q->orWhere('address', 'like',
            "%{$this->request->address}%"));
    }


    protected function gender(): Builder
    {
        return $this->builder->Where('gender', '=',
            $this->request->gender);
    }

    protected function phone_number(): Builder
    {
        return $this->builder->Where('phone_number', 'like',
            "%{$this->request->phone_number}%");
    }
}
