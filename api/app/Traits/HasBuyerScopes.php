<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasBuyerScopes
{
    public function scopeForAll(Builder $query): Builder
    {
        return $query->where('created_by' ,  Auth::user()->id);
    }
}
