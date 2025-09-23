<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $table = 'profiles';
    protected $fillable = [
        'profile_name',
        'permissions',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
