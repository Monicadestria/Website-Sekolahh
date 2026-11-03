<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SectionScope;

class Section extends Model
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
        static::bootSectionQueryScope();
    }

    public function slider()
    {
        return $this->hasMany(SectionSlider::class);
    }

    public function map()
    {
        return $this->hasOne(SectionMap::class);
    }

    public function tagline()
    {
        return $this->hasOne(SectionTagline::class);
    }
    public function hero()
    {
        return $this->hasOne(SectionHero::class);
    }
    public function ghp()
    {
        return $this->hasOne(SectionGhp::class);
    }
    public function line()
    {
        return $this->hasOne(SectionLine::class);
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
