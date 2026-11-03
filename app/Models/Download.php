<?php

namespace App\Models;

use App\Models\Master;
use App\Traits\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Download extends Model
{
    use HasFactory, SoftDeletes, UserScope;

    protected $guarded = [ ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::bootUserScope();
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function deleted_by()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }

    public function CategoryDownloads()
    {
        return $this->belongsTo(Master::class, 'category_download_id', 'id');
    }

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
