<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class StockWithdrawn extends Model implements ContractsAuditable
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
        'stock_id',
        'destination_id',
        'cpf',
        'name',
        'quantity_before',
        'quantity_updated',
        'quantity_withdrawn',
        'user_id',
        'obs',
        'sign',
        'add_id',
    ];

    public function stock(){
        return $this->hasMany(Stock::class,'id','stock_id');
    }

}
