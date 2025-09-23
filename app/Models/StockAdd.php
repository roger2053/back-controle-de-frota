<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class StockAdd extends Model implements ContractsAuditable
{
    use HasFactory;
    use Auditable;
    protected $auditEvents = [
        'created',
        'updated',
        'deleted'
    ];

    protected $dispatchesEvents = [
        'updated',
        'deleted',
    ];
    protected $fillable = [
        'quantity_before',
        'quantity_updated',
        'quantity_add',
        'stock_id',
        'user_id',
        'expiration_date',
        'quantity_used',
        'nf',
        'batch',
    ];
}
