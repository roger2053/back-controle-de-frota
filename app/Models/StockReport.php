<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockReport extends Model
{
    protected $table = 'stock_reports';

    protected $fillable = [
        'id'
    ];

    public function reports(){
        return $this->hasMany(StockReportItem::class,'report_id','id');
    }
}
