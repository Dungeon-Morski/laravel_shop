<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const CATEGORY_ID = 'category_id';
    public const COUNTRY = 'country';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::COUNTRY => [$this, 'country'],
        ];
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }

    public function country(Builder $builder, $value)
    {
        $builder->where('country', 'like', "%{$value}%");
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }
}
