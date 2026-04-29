<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Guarded([])]
class Address extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
