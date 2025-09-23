<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transport;
use App\Models\EmergencyType;
use App\Models\Emergency;
use App\Models\Locale;
use App\Models\Victim;

class Sheet extends Model
{
    use SoftDeletes;

    protected $primaryKey = "protocol";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $casts = [
        'support_transport_usa' => 'boolean',
        'support_transport_usb' => 'boolean',
        'support_transport_motolancia' => 'boolean',
        'is_evaluated' => 'boolean',
    ];

    public function transport()
    {
        return $this->belongsTo(Transport::class, 'used_transport');
    }

    public function local()
    {
        return $this->belongsTo(Locale::class, 'patient_locale');
    }

    public function emergency_type()
    {
        return $this->belongsTo(EmergencyType::class, 'emergency_type_id');
    }

    public function emergency()
    {
        return $this->belongsTo(Emergency::class, 'emergency_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function victims()
    {
        return $this->hasMany(Victim::class, 'sheet_protocol', 'protocol');
    }

    public function origin()
    {
        return $this->belongsTo(Hospital::class, 'transfer_origin');
    }

    public function destiny()
    {
        return $this->belongsTo(Hospital::class, 'transfer_destiny');
    }
}
