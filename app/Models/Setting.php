<?php

namespace App\Models;

use App\Models\User;
use App\Models\Theme;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setting extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }

    // function setSlugAttribute($value) {
    //     $this->attributes['slug'] = Str::slug($value);
    // }
}
