<?php

namespace App\Http\Repositories\Stock;

use App\Models\StockReport;
use App\Models\StockReportItem;

class ReportsRepository
{

    private $report;
    private $reportItem;
    public function __construct(StockReport $report, StockReportItem $reportItem)
    {
        $this->report = $report;
        $this->reportItem = $reportItem;
    }

    public function createReport()
    {
        return $this->report->create();
    }
    public function createReportItems($reportId, $withdrawnId)
    {
        return $this->reportItem->create([
            'report_id' => $reportId,
            'withdrawn_id' => $withdrawnId
        ]);
    }
}
