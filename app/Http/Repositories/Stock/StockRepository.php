<?php

namespace App\Http\Repositories\Stock;

use App\Models\Stock;
use App\Models\StockAdd;
use App\Models\StockReport;
use App\Models\StockWithdrawn;
use App\Models\Transport;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockRepository
{
    public function __construct(
        private Stock $stock,
        private  StockWithdrawn $stockWithdrawn,
        private StockAdd $stockAdd,
        private Transport $transport,
        private StockReport $report
    ) {}

    public function index($params)
    {
        $query = $this->stock->select(
            'stocks.id',
            'stocks.unique_cost',
            'stocks.barcode',
            'stocks.product_name',
            'stocks.product_description',
            'stocks.stock_quantity',
            'stocks.status',
            'stocks.type',
            'stocks.is_controlled',
            'transports.transport as destination',
            DB::raw("DATE_FORMAT(stocks.last_withdrawn, '%d/%m/%Y %H:%i') as last_withdrawn_formatted"),
            DB::raw("DATE_FORMAT(stocks.created_at, '%d/%m/%Y %H:%i') as created_at_formatted"),
            DB::raw("DATE_FORMAT(stocks.expiration_date, '%d/%m/%Y') as expiration_date_formatted")
        );

        $query->leftJoin('transports', 'transports.id', 'stocks.last_destination');
        $query->orderByDesc('id');

        if (!empty($params['status'])) {
            $query->where('stocks.status', $params['status']);
        }

        if (!empty($params['type'])) {
            $query->where('stocks.type', $params['type']);
        }

        if (!empty($params['start_date'])) {
            $start = date('Y-m-d', strtotime($params['start_date'])) . " 00:00:00";
            $query->whereDate('stocks.created_at', '>=', $start);
        }

        if (!empty($params['final_date'])) {
            $finalDate = date('Y-m-d', strtotime($params['final_date'])) . " 23:59:59";
            $query->whereDate('stocks.created_at', '<=', $finalDate);
        }

        if (!empty($params['barcode'])) {
            $query->where('stocks.barcode', $params['barcode']);
        }

        if (!empty($params['reference'])) {
            $query->where('stocks.reference', $params['reference']);
        }

        if (!empty($params['search'])) {
            $query->where('stocks.barcode', 'LIKE', "%" . $params['search'] . "%")->orWhere("stocks.product_name", 'LIKE', "%" . $params['search'] . "%");
        }

        return $query->paginate($params['perPage'] ?? 20, [], 'page', $params['page'] ?? 1);
    }

    public function store($params)
    {
        return $this->stock->create($params);
    }

    public function show($id)
    {
        return $this->stock->where('id', $id)->select(
            'id',
            'unique_cost',
            'barcode',
            'reference',
            "product_name",
            'product_description',
            'stock_quantity',
            'min_quantity',
            'ncm_code',
            'status',
            'type',
            'cest_code',
            'brand',
            'characteristic',
            'expiration_date',
            'unit_of_measure',
            'measure_value',
            'last_destination',
            'is_controlled',
            DB::raw("DATE_FORMAT(last_withdrawn, '%d/%m/%Y %H:%i') as last_withdrawn_formatted"),
            DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at_formatted")
        )->first();
    }

    public function updateStock($params, $id)
    {
        $stock = $this->stock->where('id', $id)->first();
        return $stock->update($params);
    }

    public function destroy($id)
    {
        return $this->stock->where('id', $id)->delete();
    }

    public function getAllStock()
    {
        return $this->stock->select('id', 'product_name')->get();
    }

    public function withDrawn($params)
    {
        return $this->stockWithdrawn->create($params);
    }

    public function addStock($params)
    {
        return $this->stockAdd->create($params);
    }

    public function history($id)
    {
        $add = $this->stockAdd->newQuery();
        $add->select(
            'stock_adds.id',
            'stock_adds.quantity_add as quantity',
            'stock_adds.quantity_before as quantity_before',
            'stock_adds.quantity_updated as quantity_updated',
            'users.name',
            'stock_adds.batch',
            DB::raw("'-' as cpf"),
            DB::raw("'-' as responsible"),
            DB::raw("'-' as destination"),
            DB::raw("'add' as type"),
            DB::raw("DATE_FORMAT(stock_adds.created_at, '%d/%m/%Y %H:%i') as created_at_formatted"),
        )
            ->where('stock_adds.stock_id', $id)
            ->leftJoin('users', 'users.id', 'stock_adds.user_id')
            ->orderBy('created_at_formatted');

        $withdrawns = $this->stockWithdrawn->newQuery();
        $withdrawns->select(
            'stock_withdrawns.id',
            'stock_withdrawns.quantity_withdrawn as quantity',
            'stock_withdrawns.quantity_before as quantity_before',
            'stock_withdrawns.quantity_updated as quantity_updated',
            'users.name',
            'stock_adds.batch',
            'stock_withdrawns.cpf',
            'stock_withdrawns.name as responsible',
            'transports.transport as destination',
            DB::raw("'withdrawn' as type"),
            DB::raw("DATE_FORMAT(stock_withdrawns.created_at, '%d/%m/%Y %H:%i') as created_at_formatted"),
        )
            ->where('stock_withdrawns.stock_id', $id)
            ->leftJoin('users', 'users.id', 'stock_withdrawns.user_id')
            ->leftJoin('transports', 'transports.id', 'stock_withdrawns.destination_id')
            ->leftJoin('stock_adds', 'stock_adds.id', 'stock_withdrawns.add_id')
            ->orderBy('created_at_formatted');
        $addQuery = $add->getQuery();
        $withdrawnsQuery = $withdrawns->getQuery();
        $total = $addQuery->union($withdrawnsQuery)->orderByDesc('created_at_formatted')->get();
        return $total;
    }

    public function top50()
    {
        $query = $this->stock->select(
            'stocks.id',
            'stocks.unique_cost',
            'stocks.barcode',
            'stocks.product_name',
            'stocks.product_description',
            'stocks.stock_quantity',
            'stocks.status',
            'stocks.type',
            'stocks.is_controlled',
            'transports.transport as destination',
            DB::raw("DATE_FORMAT(stocks.last_withdrawn, '%d/%m/%Y %H:%i') as last_withdrawn_formatted"),
            DB::raw("DATE_FORMAT(stocks.created_at, '%d/%m/%Y %H:%i') as created_at_formatted"),
            DB::raw("DATE_FORMAT(stocks.expiration_date, '%d/%m/%Y') as expiration_date_formatted")
        );

        $query->leftJoin('transports', 'transports.id', 'stocks.last_destination');
        $query->orderByDesc('last_withdrawn');

        return $query->take(50)->get();
    }

    public function getTransport($id)
    {
        return $this->transport->where('id', $id)->select('transport')->first();
    }
    public function getAdd($stockId)
    {
        return $this->stockAdd->where('stock_id', $stockId)
            ->whereColumn('quantity_add', '>', 'quantity_used')
            ->select(
                'id',
                'nf',
                'batch',
                'stock_id',
                DB::raw("DATE_FORMAT(expiration_date,'%d/%m/%Y') as expiration_date"),
                'quantity_used',
                'quantity_add'
            )
            ->get();
    }
    public function showAdd($stockId, $id)
    {
        return $this->stockAdd
            ->where('id', $id)
            ->where('stock_id', $stockId)
            ->select('nf', 'batch', 'expiration_date', 'quantity_used', 'quantity_add')
            ->first();
    }

    public function addUpdate($id, $params)
    {
        return $this->stockAdd->where('id', $id)->update($params);
    }

    public function getReports($params)
    {
        $query = $this->report->select(
            'id',
            DB::raw("DATE_FORMAT(stock_reports.created_at, '%d/%m/%Y %H:%i') as created_at_formatted"),
        );
        $query->with(['reports.withdrawns.stock']);

        $query->orderByDesc('id');

        if (!empty($params['start_date'])) {
            $start = date('Y-m-d', strtotime($params['start_date'])) . " 00:00:00";
            $query->whereDate('stock_reports.created_at', '>=', $start);
        }

        if (!empty($params['final_date'])) {
            $finalDate = date('Y-m-d', strtotime($params['final_date'])) . " 23:59:59";
            $query->whereDate('stock_reports.created_at', '<=', $finalDate);
        }

        if (!empty($params['search'])) {
            $query->where('stock_reports.barcode', 'LIKE', "%" . $params['search'] . "%")->orWhere("stock_reports.product_name", 'LIKE', "%" . $params['search'] . "%");
        }

        return $query->paginate($params['perPage'] ?? 20, [], 'page', $params['page'] ?? 1);
    }

    public function getReportById($id){

        $query = $this->report->select(
            'id',
            DB::raw("DATE_FORMAT(stock_reports.created_at, '%d/%m/%Y %H:%i') as created_at_formatted"),
        );
        $query->with([
            // 'reports' => function ($query)use($id){
            // $query->where('stock_report_items.report_id',$id);
        // },
        'reports.withdrawns.stock']);
            $query->where('stock_reports.id',$id);

        $query->orderByDesc('id');

        return $query->first()->toArray();
    }
}
