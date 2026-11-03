<?php

namespace App\Models;

use App\Models\Setting;
use App\Traits\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use SoftDeletes, UserScope;

    protected static function boot()
    {
        parent::boot();
        static::bootUserScope();
    }
    
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Get all of the setting for the Theme
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function setting()
    {
        return $this->hasMany(Setting::class, 'theme_id', 'id');
    }

    public function created_by() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by() {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
