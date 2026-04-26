<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Guarded([])]
class Brand extends Model
{
    protected $with = ['products'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
