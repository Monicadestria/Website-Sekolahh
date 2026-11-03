<?php

namespace App\Models;

use App\Models\User;
use App\Models\Access;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * Get the access that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function access(): BelongsTo
    {
        return $this->belongsTo(Access::class, 'access_id', 'id');
    }

    /**
     * The users that belong to the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_menu_table', 'menu_id', 'user_id');
    }
}
