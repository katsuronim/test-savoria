<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class apps extends Model
{
    use HasFactory;

    protected $primaryKey = 'app_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'app_code',
        'app_name',
        'app_group',
        'app_url',
        'data_status',
    ];

    public function mapUserApps(): HasMany
    {
        return $this->hasMany(map_users_apps::class);
    }
}
