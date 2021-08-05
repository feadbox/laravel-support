<?php

namespace Feadbox\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Feadbox\Support\Components\Money as MoneyComponent;

class Money extends Model
{
    protected $fillable = [
        'price',
    ];

    protected $appends = [
        'format',
    ];

    public function getFormatAttribute()
    {
        return MoneyComponent::format($this->price);
    }

    public function times(int $quantity): self
    {
        $this->price *= $quantity;

        return $this;
    }

    public function cents(): int
    {
        return $this->price ?? 0;
    }

    public function float()
    {
        return MoneyComponent::convertFromCents($this->price);
    }

    public function withoutPrefix(): string
    {
        return MoneyComponent::formatWithoutPrefix($this->price);
    }

    public function formatIfExists(): string
    {
        return  $this->price > 0 ? $this->getFormatAttribute() : '';
    }

    public function __toString(): string
    {
        return $this->getFormatAttribute();
    }
}
