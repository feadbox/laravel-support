<?php

namespace Feadbox\Support\Casts;

use Feadbox\Support\Components\Money as MoneyComponent;
use Feadbox\Support\Models\Money as MoneyModel;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return new MoneyModel(['price' => $value]);
    }

    public function set($model, $key, $value, $attributes)
    {
        return MoneyComponent::toFloat($value);
    }
}
