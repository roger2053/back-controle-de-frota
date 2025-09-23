<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sheet;
use App\Models\Status;
use App\Models\Victim;

class DashboardController extends Controller
{
    public function attendance(){

        $actualMonth = date('m');

        $statusList = Status::all();

        $statusSheets = Sheet::select(DB::Raw('count(*) as total, status_id'))
            ->where('deleted_at', null)
            ->whereMonth('created_at', $actualMonth)
            ->with('status')
            ->groupBy('status_id')
            ->get();

        $transfer = Sheet::whereNotNull('transfer_code')
            ->where('deleted_at', null)
            ->whereMonth('created_at', $actualMonth)
            ->get()
            ->count();



        $guidelines = Victim::where('deleted_at', null)
            ->where('emergency_id', 7)
            ->whereMonth('created_at', $actualMonth)
            ->get()
            ->count();

        $responseStatus = array();

        foreach($statusSheets as $element){
            if($element["status"]){
                if($element->status->status == "Repasse de Informação"){
                    $responseStatus["Repasse"] = $element->total;
                    continue;
                }

                if($element->status->status == "Trote com Deslocamento"){
                    $responseStatus["TroteDeslocamento"] = $element->total;
                    continue;
                }

                $responseStatus[$element->status->status] = $element->total;
            }

        }

        $responseStatus['Transferencias'] = $transfer;
        $responseStatus['Orientacoes'] = $guidelines;
        $responseStatus['Transporte'] = Sheet::whereIn('used_transport',[3,4,5,6,7])
        ->get()
        ->count();
        $totalSheets = Sheet::where('deleted_at', null)
            ->whereMonth('created_at', $actualMonth)
            ->get()->count();

        return response()->json(['error' => false, 'data' => ['status' => $responseStatus, 'totalSheets' => $totalSheets] ]);


    }

    public function cases(){

        $actualMonth = date('m');

        $statusList = Status::all();

        $cases = Victim::select(
            DB::Raw("SUM(IF(emergency_type_id=29, 1, 0)) AS covid19,
                    SUM(IF(emergency_type_id=31, 1, 0)) AS sintomasGripais,
                    SUM(IF(emergency_id=1, 1, 0)) AS traumaticos,
                    SUM(IF(emergency_id=2, 1, 0)) AS clinicos")
            )
            ->where('deleted_at', null)
            ->whereMonth('created_at', $actualMonth)
            ->get();


        return response()->json(['error' => false, 'data' => $cases ] );


    }
}
