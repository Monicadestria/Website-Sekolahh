<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SectionScope
{
    public static function bootSectionCrudScope()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
            // $model->created_at = now()->format('Y-m-d H:i:s');
            // $model->updated_at = now()->format('Y-m-d H:i:s');
            // $model->save();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
            $model->updated_at = now()->format('Y-m-d H:i:s');
            // $model->save();
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->save();
        });
    }
    public static function bootSectionQueryScope()
    {
        static::addGlobalScope('section_query_scope', function ($query) {
            $query->where('created_by', Auth::id());
        });
    }
}
