<?php

namespace Feadbox\Support\Casts;

use Feadbox\Support\Models\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return new Money(['price' => $value]);
    }

    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
