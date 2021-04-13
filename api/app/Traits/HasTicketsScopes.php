<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasTicketsScopes
{
    public function scopeForAvailable(Builder $query, $available): Builder
    {
        return $query->where('created_by', Auth::user()->id)
            ->where('available', filter_var($available, FILTER_VALIDATE_BOOLEAN))
            ->whereNull('buyer_id');
    }

    public function scopeForAll(Builder $query): Builder
    {
        return $query->where('created_by', Auth::user()->id);
    }
}
