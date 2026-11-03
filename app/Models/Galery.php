<?php

namespace App\Models;

use App\Models\Master;
use App\Traits\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galery extends Model
{
    use HasFactory, SoftDeletes, UserScope;

    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    
    // protected $appends = ['video_url'];

    protected static function boot()
    {
        parent::boot();
        static::bootUserScope();
    }

    public function getVideoUrlAttribute()
    {
        $videoUrl = $this->video;
        $videoUrl = explode('/', $videoUrl);
        $videoUrl = end($videoUrl);

        return $videoUrl;
    }

    /**
     * Get the category_galery that owns the Galery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category_galery()
    {
        return $this->belongsTo(Master::class, 'category_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
