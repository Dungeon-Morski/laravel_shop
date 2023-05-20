<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends AbstractFilter
{
    public const STATUS = 'status';


    protected function getCallbacks(): array
    {
        return [
            self::STATUS => [$this, 'status'],
        ];
    }


    public function status(Builder $builder, $value)
    {
        $builder->where('status', 'like', "%{$value}%");
    }
}
