<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockReportItem extends Model
{
    protected $table = 'stock_report_items';
    protected $fillable = [
        'report_id',
        'withdrawn_id'
    ];

    public function reports(){
        return $this->hasMany(StockReport::class,'id','report_id');
    }

    public function withdrawns(){
        return $this->hasMany(StockWithdrawn::class,'id','withdrawn_id');
    }
}
