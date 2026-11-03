<?php

namespace App\Models;

use App\Traits\SectionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionGhp extends Model
{
    use HasFactory, SoftDeletes, SectionScope;

    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::bootSectionCrudScope();
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function img()
    {
        return $this->hasMany(SectionGhpImg::class);
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
