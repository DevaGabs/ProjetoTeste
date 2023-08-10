<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'cnpj',
        'whatsapp_phone',
        'representantive_user',
        'category_id',
        'city_id',
        'state_id',
        'latitude',
        'longitude',
        'notes',
    ];

    protected $appends = [
        'cnpj_readable'
    ];

    protected function cnpj(): Attribute
    {
        return Attribute::set(function ($value) {
            return preg_replace('/[^0-9]/', '', $value);
        });
    }

    protected function getCnpjReadableAttribute(): string
    {
        return maskFormat(
            $this->cnpj,
            '##.###.###/####-##'
        );
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
