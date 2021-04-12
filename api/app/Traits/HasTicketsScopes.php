<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasTicketsScopes
{
    public function scopeForAvailable(Builder $query): Builder
    {
        return $query->where('created_by' ,  Auth::user()->id)
            ->where('available', true);
    }
}
