<?php

namespace App\Models;

use App\Traits\UserScope;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory, SoftDeletes, UserScope;
    use sluggable;
    use HasUuids;

    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fileNameToStore = ['photo', 'category_berita_id', 'title', 'slug', 'body'];

    protected static function boot()
    {
        parent::boot();
        static::bootUserScope();
    }

    public function CategoryBerita()
    {
        return $this->belongsTo(Master::class, 'category_berita_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
