<?php

namespace App\Models;

use App\Traits\UserScope;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staf extends Model
{
    use HasFactory, SoftDeletes, UserScope;
    use HasUuids;

    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::bootUserScope();
    }

    public function category()
    {
        return $this->belongsTo(Master::class, 'category_staf_id', 'id');
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
}
