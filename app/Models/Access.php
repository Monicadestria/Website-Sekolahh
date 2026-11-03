<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Access extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'access_id', 'id');
    }

    /**
     * The users that belong to the Access
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_access_table', 'access_id', 'user_id');
    }
}
