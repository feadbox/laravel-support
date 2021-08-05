<?php

namespace Feadbox\Support;

use BenSampo\Enum\Enum as Base;
use Illuminate\Support\Str;

abstract class Enum extends Base
{
    public function __get($name)
    {
        $methodName = Str::camel("get_{$name}_attribute");

        if (!method_exists($this, $methodName)) {
            return;
        }

        return $this->{$methodName}($this->value);
    }

    public static function __callStatic($name, $arguments)
    {
        $method = Str::of($name)
            ->singular()
            ->replace('getAll', null)
            ->prepend('get')
            ->append('Attribute')
            ->__toString();

        if (!method_exists(static::class, $method)) {
            return parent::__callStatic($name, $arguments);
        }

        return collect(static::getValues())
            ->mapWithKeys(fn ($value) => [$value => static::{$method}($value)])
            ->toArray();
    }
}
