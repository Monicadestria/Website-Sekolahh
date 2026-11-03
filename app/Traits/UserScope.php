<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserScope
{
    public static function bootUserScope()
    {
        static::addGlobalScope('user_query_scope', function ($query) {
            $query->where('created_by', Auth::id());
        });

        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->save();
        });
    }
}
