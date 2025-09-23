<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $primaryKey='id';
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'was_read',
        'is_alert',
        'created_at',
        'updated_at',
    ];
}
