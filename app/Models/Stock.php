<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Stock extends Model implements ContractsAuditable
{
    use SoftDeletes;
    use Auditable;
    protected $table='stocks';
    protected $primaryKey='id';
    protected $auditEvents = [
        'created',
        'updated',
        'deleted'
    ];

    protected $dispatchesEvents = [
        'created',
        'updated',
        'deleted',
    ];
    protected $fillable = [
        'unique_cost',
        'barcode',
        'reference',
        'product_name',
        'product_description',
        'stock_quantity',
        'ncm_code',
        'status',
        'type',
        'cest_code',
        'brand',
        'characteristic',
        'expiration_date',
        'unit_of_measure',
        'measure_value',
        'min_quantity',
        'last_withdrawn',
        'last_destination',
        'is_controlled',
        'cnpj',
        'social_reason',
        'fantasy_name',
    ];
}
