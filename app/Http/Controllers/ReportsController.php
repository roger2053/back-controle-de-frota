<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;
use App\Models\Victim;
use App\Models\Locale;
use App\Models\City;
use App\Models\EmergencyType;
use App\Models\Emergency;
use App\Models\Hospital;
use App\Models\Transport;
use Illuminate\Support\Facades\DB;
use Validator;
use PDF;
use Carbon\Carbon;

class ReportsController extends Controller
{
    function daily_statistic_01(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'initial_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
            'final_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }
        //TimeZone está fixo
        $request->timezone = 3;
        $request->initial_date = Carbon::parse($request->initial_date);
        $request->final_date = Carbon::parse($request->final_date);

        $start = $request->initial_date->copy()->addHours($request->timezone);
        $end = $request->final_date->copy()->addHours($request->timezone);

        $turns = array(
            'extraNight' => ['init' => "00:00:00", 'end' => "06:59:59"],
            'morning' => ['init' => "07:00:00", 'end' => "12:59:59"],
            'afternoon' => ['init' => "13:00:00", 'end' => "18:59:59"],
            'night' => ['init' => "19:00:00", 'end' => "23:59:59"],
        );

        $report_global = array();
        $report_bases_turn = array();

        $cities = City::all();
        $veichles = Transport::all();

        $dbg = [];
        $reportFiltred = Sheet::select('protocol')
            ->whereBetween(
                DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"),
                [$start->format('Y-m-d H:i:00'), $end->format('Y-m-d H:i:59')]
            )
            ->get()
            ->pluck('protocol')
            ->toArray();

        $orientacoesFiltred = Victim::select('id')
            ->whereBetween(
                DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"),
                [$start->format('Y-m-d H:i:00'), $end->format('Y-m-d H:i:59')]
            )
            ->whereNull('deleted_at')  // Added the null check that was present in the later queries
            ->get()
            ->pluck('id')
            ->toArray();

        foreach ($turns as $turn => $time) {
            $report = Sheet::select(DB::raw("SUM(status_id=4) AS 'Chamadas Interrompidas',
                SUM(status_id=5) AS 'Trote',
                SUM(status_id=7) AS 'Trote com Deslocamento',
                SUM(status_id=6) AS 'Repasse de Informações',
                SUM(emergency_id=7) AS  'Orientações',
                count(*) AS 'Total de Chamadas'"))
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $start)
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $end)
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $time["init"])
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $time["end"])
                ->whereIn('sheets.protocol', $reportFiltred)
                ->get();

            $orientacoes = Victim::select(DB::raw("SUM(emergency_id=7) AS  'Orientações'"))
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $start)
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $end)
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $time["init"])
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $time["end"])
                ->whereNull('deleted_at')
                ->whereIn('victims.id', $orientacoesFiltred)
                ->get();

            $report[0]["Orientações"] = $orientacoes[0]["Orientações"];

            $sheets = Sheet::select('*')
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $start)
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $end)
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $time["init"])
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $time["end"])
                ->whereNull('deleted_at')
                ->with('transport')
                ->whereIn('sheets.protocol', $reportFiltred)
                ->get();

            $report_global[$turn] = statistic_tratament_01($report, $sheets->toArray(), $veichles);
            $report_bases_turn[$turn] = $report_global[$turn]['bases'];

            unset($report_global[$turn]['bases']);
        }


        $arrayLabels = array(
            'EXTRA NOITE' => ['turn' => 'extraNight', 'time' => '(Das 00:00 às 07:00h)'],
            'MANHÃ' => ['turn' => 'morning', 'time' => '(Das 07:00 às 13:00 h)'],
            'TARDE' => ['turn' => 'afternoon', 'time' => '(Das 13:00 às 19:00 h)'],
            'NOITE' => ['turn' => 'night', 'time' => '(Das 19:00 às 00:00 h)'],
            'TOTAL' => ['turn' => 'total', 'time' => '']
        );

        $report_global['info']['type'] = "ESTATÍSTICA DIÁRIA 01";
        $report_global['info']['title'] = concat_timestamps("relatorio");
        $report_global['info']['initial_date'] = date("d/m/Y", strtotime($request->initial_date));
        $report_global['info']['final_date'] = date("d/m/Y", strtotime($request->final_date));

        $report_global = statistic_tratament_agroup_items($report_global);
        //return response($report_global);
        // return PDF::loadView('reports.statistic.daily_01', compact(['report_global', 'arrayLabels', 'report_bases_turn']))->download("Report.pdf");
        $pdf = PDF::loadView('reports.statistic.daily_01', compact(['report_global', 'arrayLabels', 'report_bases_turn']));
        $pdf->setPaper('tabloid', 'landscape'); // Define a orientação para paisagem
        return $pdf->download("Report.pdf");
    }

    function daily_statistic_02(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'initial_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
            'final_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }
        $request->timezone = 3;
        $request->initial_date = Carbon::parse($request->initial_date)->startOfDay();
        $request->final_date = Carbon::parse($request->final_date)->endOfDay();

        $start = $request->initial_date->copy()->addHours($request->timezone);
        $end = $request->final_date->copy()->addHours($request->timezone);

        $reportFiltred = Sheet::select('protocol')
            ->whereBetween(
                DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"),
                [$start->format('Y-m-d H:i:00'), $end->format('Y-m-d H:i:59')]
            )
            ->get()
            ->pluck('protocol')
            ->toArray();


        $turns = array(
            'extraNight' => ['init' => "00:00:00", 'end' => "06:59:59"],
            'morning' => ['init' => "07:00:00", 'end' => "12:59:59"],
            'afternoon' => ['init' => "13:00:00", 'end' => "18:59:59"],
            'night' => ['init' => "19:00:00", 'end' => "23:59:59"],
        );

        $report_global = array();

        $locales = Locale::select('id', 'locale')->get();

        foreach ($turns as $turn => $time) {

            $data = Sheet::select('*')
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $start)
                ->whereDate(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $end)
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '>=', $time["init"])
                ->whereTime(DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"), '<=', $time["end"])
                ->whereIn('protocol', $reportFiltred)
                ->with('victims')
                ->with('local')
                ->get();

            $report_global[$turn] = statistic_tratament_02($data, $locales);
        }

        $report_global['info']['type'] = "ESTATÍSTICA DIÁRIA 02";
        $report_global['info']['title'] = concat_timestamps("relatorio");
        $report_global['info']['initial_date'] = date("d/m/Y", strtotime($request->initial_date));
        $report_global['info']['final_date'] = date("d/m/Y", strtotime($request->final_date));

        $report_global['total'] = statistic_totals($report_global['extraNight'], $report_global['morning'], $report_global['night'], $report_global['afternoon']);

        // return PDF::loadView('reports.statistic.daily_02', compact('report_global'))->download("Report.pdf");
        $pdf = PDF::loadView('reports.statistic.daily_02', compact('report_global'));
        $pdf->setPaper('b3', 'landscape'); // Define a orientação para paisagem
        return $pdf->download("Report.pdf");
    }

    function daily_statistic_03(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'initial_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
            'final_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $request->timezone = 3;

        $request->initial_date = Carbon::parse($request->initial_date);
        $request->final_date = Carbon::parse($request->final_date);

        $start = $request->initial_date->copy()->addHours($request->timezone);
        $end = $request->final_date->copy()->addHours($request->timezone);

        $turns = array(
            'night' => ['init' => "19:00:00", 'end' => "23:59:59"],
            'extraNight' => ['init' => "00:00:00", 'end' => "06:59:59"],
            'morning' => ['init' => "07:00:00", 'end' => "12:59:59"],
            'afternoon' => ['init' => "13:00:00", 'end' => "18:59:59"],
        );

        $emergencyTypes = EmergencyType::all();
        $emergencies = Emergency::all();

        $queryStringEmergencyTypes = "";

        foreach ($emergencyTypes as $emergency) {
            $queryStringEmergencyTypes .= "SUM(emergency_type_id=$emergency->id) AS '$emergency->emergency_type',";
        }

        $queryStringEmergencyTypes = rtrim($queryStringEmergencyTypes, ",");

        $report_global = array();


        $orientacoesFiltred = Victim::select('id')
            ->whereBetween(
                DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"),
                [$start->format('Y-m-d H:i:00'), $end->format('Y-m-d H:i:59')]
            )
            ->whereNull('deleted_at')  // Added the null check that was present in the later queries
            ->get()
            ->pluck('id')
            ->toArray();

        foreach ($turns as $turn => $time) {

            $report = Victim::select(DB::raw($queryStringEmergencyTypes))
                // ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array( $request->initial_date, $request->final_date ))
                ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array($start, $end))
                ->whereRaw("TIME(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN ? AND ? ", array($time["init"], $time["end"]))
                // ->where('victims.created_at','>=',$start_timezone)
                ->whereIn('id', $orientacoesFiltred)
                ->get();

            $subs = Victim::select(DB::raw("SUM(emergency_id=5) as 'Abuso Sexual',
                                            SUM(emergency_id=6) as 'Violência Doméstica',
                                            SUM(emergency_id=7) as 'Orientação',
                                            SUM(emergency_id=6) as 'Não sabe'"))
                // ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array( $request->initial_date, $request->final_date ))
                ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array($start, $end))
                ->whereRaw("TIME(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN ? AND ? ", array($time["init"], $time["end"]))
                // ->where('victims.created_at','>=',$start_timezone)
                ->whereIn('id', $orientacoesFiltred)
                ->get();

            $subs = $subs[0]->toArray();

            $newSubs = [];
            foreach ($subs as $key => $value) {
                if ($value == null) {
                    $newSubs[$key] = 0;
                } else {
                    $newSubs[$key] = intval($value);
                }
            }

            $subs = $newSubs;

            $trated = statistic_tratament_03($report, $emergencies, $emergencyTypes, $turn);
            $trated['Violência Doméstica'] = ['Violência Doméstica' => $subs['Violência Doméstica']];
            $trated['Orientação'] = ['Orientação' => $subs['Orientação']];
            $trated['Não sabe'] = ['Não sabe' => $subs['Não sabe']];
            $trated['Abuso Sexual'] = ['Abuso Sexual' => $subs['Abuso Sexual']];

            $report_global = array_merge($report_global, [$turn => $trated]);
        }

        $ocorrencies = [];

        foreach ($report_global as $turn => $values) {
            foreach ($values as $category => $value) {
                if (gettype($value) != "string") {
                    if (sizeof($value) >= 1) {
                        foreach ($value as $ocorrencie => $qtd) {
                            if (!isset($ocorrencies[$category][$ocorrencie])) {
                                $ocorrencies[$category] = [];
                                $ocorrencies[$category][$ocorrencie] = [
                                    'night' => 0,
                                    'extraNight' => 0,
                                    'morning' => 0,
                                    'afternoon' => 0
                                ];
                                $ocorrencies[$category][$ocorrencie][$turn] = intval($qtd);
                            } else {
                                $ocorrencies[$category][$ocorrencie][$turn]  += intval($qtd);
                            }
                        }
                    }
                }
            }
        }

        $report_global = $ocorrencies;
        $report_global['info']['type'] = "ESTATÍSTICA DIÁRIA 03";
        $report_global['info']['title'] = concat_timestamps("relatorio");
        $report_global['info']['initial_date'] = date("d/m/Y", strtotime($request->initial_date));
        $report_global['info']['final_date'] = date("d/m/Y", strtotime($request->final_date));

        //return $report_global;
        // return PDF::loadView('reports.statistic.daily_03', compact('report_global'))->download("Report.pdf");
        $pdf = PDF::loadView('reports.statistic.daily_03', compact('report_global'));
        $pdf->setPaper('tabloid', 'landscape'); // Define a orientação para paisagem
        return $pdf->download("Report.pdf");
    }

    function daily_statistic_04(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'initial_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
            'final_date' => 'required|date_format:Y-m-d,Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $request->timezone = 3;

        $request->initial_date = Carbon::parse($request->initial_date);
        $request->final_date = Carbon::parse($request->final_date);

        $start = $request->initial_date->copy()->addHours($request->timezone);
        $end = $request->final_date->copy()->addHours($request->timezone);

        $turns = array(
            'extraNight' => ['init' => "00:00:00", 'end' => "06:59:59"],
            'morning' => ['init' => "07:00:00", 'end' => "12:59:59"],
            'afternoon' => ['init' => "13:00:00", 'end' => "18:59:59"],
            'night' => ['init' => "19:00:00", 'end' => "23:59:59"],
        );

        $report_global = array();

        $emergencies = Emergency::all();
        $tranports = Transport::all();
        $hospitals = Hospital::all();

        $queryStringEmergencies = "";
        $queryStringTransports = "";
        $queryStringHospitals = "";

        foreach ($emergencies as $emergency) {
            $queryStringEmergencies .= "SUM(emergency_id=$emergency->id) AS '$emergency->emergency',";
        }

        foreach ($tranports as $transport) {
            $queryStringTransports .= "SUM(used_transport=$transport->id) AS '$transport->transport',";
        }

        foreach ($hospitals as $hospital) {
            if ($hospital->id != 28) {
                $queryStringHospitals .= "SUM(transfer_destiny=$hospital->id) AS '$hospital->name',";
            }
        }

        $queryStringEmergencies = rtrim($queryStringEmergencies, ",");
        $queryStringTransports = rtrim($queryStringTransports, ",");
        $queryStringHospitals = rtrim($queryStringHospitals, ",");

        $totalOcorrencies = array();

        $reportFiltred = Sheet::select('protocol')
            ->whereBetween(
                DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"),
                [$start->format('Y-m-d H:i:00'), $end->format('Y-m-d H:i:59')]
            )
            ->get()
            ->pluck('protocol')
            ->toArray();

        $orientacoesFiltred = Victim::select('id')
            ->whereBetween(
                DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)"),
                [$start->format('Y-m-d H:i:00'), $end->format('Y-m-d H:i:59')]
            )
            ->whereNull('deleted_at')  // Added the null check that was present in the later queries
            ->get()
            ->pluck('id')
            ->toArray();

        foreach ($turns as $turn => $time) {

            $report_global[$turn] = array();

            $geralOcorrencies = Victim::select(DB::raw($queryStringEmergencies))
                // ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array( $request->initial_date, $request->final_date ))
                ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array($start, $end))
                ->whereRaw("TIME(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN ? AND ? ", array($time["init"], $time["end"]))
                // ->where('victims.created_at','>=',$start_timezone)
                ->whereIn('id', $orientacoesFiltred)
                ->get();

            $typesTransports = Sheet::select(DB::raw($queryStringTransports))
                // ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array( $request->initial_date, $request->final_date ))
                ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array($start, $end))
                ->whereRaw("TIME(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN ? AND ? ", array($time["init"], $time["end"]))
                // ->where('sheets.created_at','>=',$start_timezone)
                ->whereIn('protocol', $reportFiltred)
                ->get();

            $destinyTransfer = Sheet::select(DB::raw($queryStringHospitals))
                ->where('transfer_destiny', '!=', 28)
                ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array($start, $end))
                ->whereRaw("TIME(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN ? AND ? ", array($time["init"], $time["end"]))
                ->whereIn('protocol', $reportFiltred)
                ->get();

            $otherDestiny = Sheet::select(DB::raw('count(other_transfer_destiny) as total, other_transfer_destiny'))
                ->where('transfer_destiny', 28)
                ->groupBy('other_transfer_destiny')
                // ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array( $request->initial_date, $request->final_date ))
                ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array($start, $end))
                ->whereRaw("TIME(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN ? AND ? ", array($time["init"], $time["end"]))
                ->whereIn('protocol', $reportFiltred)
                ->get();


            $obitos = Sheet::where(function ($query) {
                $query->where('incident_death_in_place', true)
                    ->orWhere('incident_death_in_transport', true);
            })
                ->whereRaw("DATE(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN DATE(?) AND DATE(?) ", array($request->initial_date, $request->final_date))
                ->whereRaw("TIME(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) BETWEEN ? AND ? ", array($time["init"], $time["end"]))
                ->whereIn('protocol', $reportFiltred)
                ->count();

            $report_global[$turn]["ocorrencies"] = statistic_tratament_04($geralOcorrencies);
            $report_global[$turn]["typesTransports"] = statistic_tratament_04($typesTransports);
            $report_global[$turn]["destinyTransfer"] = array_merge(statistic_tratament_04($destinyTransfer), statistic_tratament_agroup_other_destinations($otherDestiny));
            $report_global[$turn]["deaths"] = $obitos;
        }

        $report_global['transferDetails'] = Sheet::select(
                'sheets.transfer_origin',
                'sheets.transfer_destiny',
                \DB::raw('COUNT(protocol) as total'),
                \DB::raw('MAX(origin_hospital.name) as transfer_origin_name'),
                \DB::raw('MAX(destiny_hospital.name) as transfer_destiny_name')
            )
            ->join('hospitals as origin_hospital', 'sheets.transfer_origin', '=', 'origin_hospital.id')
            ->join('hospitals as destiny_hospital', 'sheets.transfer_destiny', '=', 'destiny_hospital.id')
            ->whereIn('protocol', $reportFiltred)
            ->whereNull('sheets.deleted_at')
            ->groupBy('sheets.transfer_origin', 'sheets.transfer_destiny')
            ->get();
        $report_global['hospitals'] = $hospitals->pluck('name', 'id');


        $report_global = statistic_tratament_agroup_turns($report_global, "ocorrencies");
        $report_global = statistic_tratament_agroup_turns($report_global, "destinyTransfer");
        $report_global = statistic_tratament_agroup_turns($report_global, "typesTransports");

        $report_global['info']['type'] = "ESTATÍSTICA DIÁRIA 04";
        $report_global['info']['title'] = concat_timestamps("relatorio");
        $report_global['info']['initial_date'] = date("d/m/Y", strtotime($request->initial_date));
        $report_global['info']['final_date'] = date("d/m/Y", strtotime($request->final_date));

        // return PDF::loadView('reports.statistic.daily_04', compact('report_global'))->download("Report.pdf");
        $pdf = PDF::loadView('reports.statistic.daily_04', compact('report_global'));
        $pdf->setPaper('tabloid', 'landscape'); // Define a orientação para paisagem
        return $pdf->download("Report.pdf");
    }

    function monthly_samu_basic(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $date = $request->month;
        $month = date('m', strtotime($request->month));
        $year = date('Y', strtotime($request->month));

        $report = array();

        $exitsUsb01 = Sheet::select(DB::raw('count(*) as exits, date(created_at) as datef')) // Não seja trote, interrompida, nem repasse e nem transferência
            ->where('used_transport', 8) // USB-01 código 8
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 7, 6])
            ->whereNull('transfer_code')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('datef')
            ->get();

        $transferUsb01 = Sheet::select(DB::raw('count(*) as transfer, date(created_at) as datef'))
            ->where('used_transport', 8) // USB-01 código 8
            ->whereNull('deleted_at')
            ->whereNotNull('transfer_code')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('datef')
            ->get();

        $totalExits = 0;
        foreach ($exitsUsb01 as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['exits_usb01'][$day] = $data['exits'] ?? 0;
            $totalExits += $data['exits'] ?? 0; // Somatório no totalizador geral

        }

        $totalTransfer = 0;
        foreach ($transferUsb01 as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['transfer_usb01'][$day] = $data['transfer'] ?? 0;
            $totalTransfer += $data['transfer'] ?? 0; // Somatório no totalizador geral

        }

        $report['exits_usb01']['total'] = $totalExits;
        $report['transfer_usb01']['total'] = $totalTransfer;

        $cnes = str_split("6939945");


        return PDF::loadView('reports.monthly.029_samu_basic', compact('report', 'month', 'year', 'cnes'))->setPaper('a4', 'landscape')->download("Report.pdf");
    }

    function monthly_regulation_center(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $date = $request->month;
        $month = date('m', strtotime($request->month));
        $year = date('Y', strtotime($request->month));

        $report = array();

        // Telefonista
        $allCalls = Sheet::select(
            DB::raw("count(*) as calls"),
            // DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone)) as datef")
            // DB::raw("CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone) as datef"),
            'created_at as datef'
        )
            ->whereNull('deleted_at')
            ->whereMonth(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $month)
            ->whereYear(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $year)
            ->groupBy('created_at')
            // ->groupBy(DB::raw("datef"))
            // ->groupBy(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"))
            ->get();

        // Radio Operador
        $transportExits = Sheet::select(
            DB::raw("count(*) as exits"),
            // DB::raw("CONVERT_TZ(`created_at`, @@session.time_zone, @@global.time_zone) as datef")
            'created_at as datef'

        )
            ->whereNotNull('used_transport')
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 6])
            ->whereNull('transfer_code')
            ->whereMonth(DB::raw("CONVERT_TZ(`created_at`, @@session.time_zone, @@global.time_zone)"), $month)
            ->whereYear(DB::raw("CONVERT_TZ(`created_at`, @@session.time_zone, @@global.time_zone)"), $year)
            ->groupBy('created_at')
            // ->groupBy(DB::raw("datef"))
            ->get();
        // Orientações
        $guidelines = Sheet::select(
            DB::raw("count(*) as guidelines"),
            'created_at as datef'
            // DB::raw("date(CONVERT_TZ('created_at',@@session.time_zone,@@global.time_zone)) as datef")
        )
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5])
            ->where('emergency_id', 7)
            ->whereMonth(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $month)
            ->whereYear(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $year)
            ->groupBy('created_at')
            // ->groupBy(DB::raw("date(CONVERT_TZ('created_at',@@session.time_zone,@@global.time_zone)) "))
            ->get();

        // Todas as movimentações de USB
        $allUsb = Sheet::select(
            DB::raw("count(*) as usbexit"),
            'created_at as datef'
            // DB::raw("date(CONVERT_TZ('created_at',@@session.time_zone,@@global.time_zone)) as datef")
        )
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 7, 6])
            ->whereBetween('used_transport', [8, 23])
            ->whereMonth(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $month)
            ->whereYear(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $year)
            ->groupBy('created_at')
            // ->groupBy(DB::raw("date(CONVERT_TZ('created_at',@@session.time_zone,@@global.time_zone))"))
            ->get();

        // Todas as movimentações de USA
        $allUsa = Sheet::select(
            DB::raw("count(*) as usaexit"),
            'created_at as datef'
            // DB::raw("date(CONVERT_TZ('created_at',@@session.time_zone,@@global.time_zone)) as datef")
        )
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 7, 6])
            ->whereIn('used_transport', [3, 4])
            ->whereMonth(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $month)
            ->whereYear(DB::raw("date(CONVERT_TZ(`created_at`,@@session.time_zone,@@global.time_zone))"), $year)
            ->groupBy('created_at')
            // ->groupBy(DB::raw("date(CONVERT_TZ('created_at',@@session.time_zone,@@global.time_zone))"))
            ->get();

        // Totalizadores
        $report['all_calls'] = array_fill_keys(range(1, 31), 0);
        $report['transport_exits'] = array_fill_keys(range(1, 31), 0);
        $report['guidelines'] = array_fill_keys(range(1, 31), 0);
        $report['usb_exit'] = array_fill_keys(range(1, 31), 0);
        $report['usa_exit'] = array_fill_keys(range(1, 31), 0);
        $totalCalls = 0;
        foreach ($allCalls as $data) {

            $calls = !empty($data['calls']) ? intval($data['calls']) : 0;
            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['all_calls'][$day] += $calls;
            $totalCalls += $calls; // Somatório no totalizador geral

        }

        $totalExits = 0;

        foreach ($transportExits as $data) {

            $exits = !empty($data['exits']) ? intval($data['exits']) : 0;
            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['transport_exits'][$day] = intval($report['transport_exits'][$day]) + $exits;
            $totalExits += $exits; // Somatório no totalizador geral

        }

        $totalGuidelines = 0;
        foreach ($guidelines as $data) {

            $guidelines = !empty($data['guidelines']) ? intval($data['guidelines']) : 0;
            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['guidelines'][$day] += $guidelines;
            $totalGuidelines += $guidelines; // Somatório no totalizador geral

        }

        $totalUsb = 0;
        foreach ($allUsb as $data) {

            $usbexit = !empty($data['usbexit']) ? intval($data['usbexit']) : 0;
            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['usb_exit'][$day] +=  $usbexit;
            $totalUsb +=  $usbexit; // Somatório no totalizador geral

        }
        $totalUsa = 0;
        foreach ($allUsa as $data) {
            $usaexit = !empty($data['usaexit']) ? intval($data['usaexit']) : 0;
            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['usa_exit'][(string)$day] += $usaexit;
            $totalUsa += $usaexit; // Somatório no totalizador geral

        }

        $report['all_calls']['total'] = $totalCalls;
        $report['transport_exits']['total'] = $totalExits;
        $report['guidelines']['total'] = $totalGuidelines;
        $report['usb_exit']['total'] = $totalUsb;
        $report['usa_exit']['total'] = $totalUsa;

        $cnes = str_split("5841976");


        return PDF::loadView('reports.monthly.028_center_regulation', compact('report', 'month', 'year', 'cnes'))->setPaper('a4', 'landscape')->download("Report.pdf");
    }

    function monthly_motolancia(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $date = $request->month;
        $month = date('m', strtotime($request->month));
        $year = date('Y', strtotime($request->month));

        $report = array();

        $motoExits = Sheet::select(DB::raw("count(*) as exits"), 'created_at as datef') // Não seja trote, interrompida, nem repasse e nem transferência
            ->whereIn('used_transport', [1, 2]) // 1 e 2 = Motolancias
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 7, 6])
            ->whereNull('transfer_code')
            // ->whereRaw("month(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $month)
            // ->whereRaw("year(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $year)
            ->whereMonth(DB::raw("created_at"), $month)
            ->whereYear(DB::raw("created_at"), $year)

            ->groupBy('datef')
            ->get();

        $totalExits = 0;
        $report['moto_exits'] = array_fill_keys(range(1, 31), 0);
        foreach ($motoExits as $data) {

            $exits = !empty($data['exits']) ? intval($data['exits']) : 0;
            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['moto_exits'][$day] += $exits;
            $totalExits += $exits; // Somatório no totalizador geral

        }

        $report['moto_exits']['total'] = $totalExits;

        $cnes = str_split("6965547");

        return PDF::loadView('reports.monthly.030_motolancia', compact('report', 'month', 'year', 'cnes'))->setPaper('a4', 'landscape')->download("Report.pdf");
    }

    function monthly_ambulance_reserve(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $date = $request->month;
        $month = date('m', strtotime($request->month));
        $year = date('Y', strtotime($request->month));

        $report = array();

        //NA PARTE DE BAIXOU CONTABILIZAR TODA TRANSFERENCIA FEITA PELA RT 01

        $reserveExits = Sheet::select(DB::raw("count(*) as exits")) // Não seja trote, interrompida, nem repasse e nem transferência
            ->where('used_transport', 23)
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 7, 6])
            ->whereNull('transfer_code')
            ->whereRaw("month(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $month)
            ->whereRaw("year(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $year)
            ->groupBy('created_at')
            ->get();

        $reserveTransfer = Sheet::select(DB::raw("count(*) as transfer")) // Não seja trote, interrompida, nem repasse e nem transferência
            ->where('used_transport', 23)
            ->whereNull('deleted_at')
            ->whereNotNull('transfer_code')
            ->whereRaw("month(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $month)
            ->whereRaw("year(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $year)
            ->groupBy('created_at')
            ->get();

        $totalExits = 0;
        foreach ($reserveExits as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['reserve_exits'][$day] = $data['exits'] ?? 0;
            $totalExits += $data['exits'] ?? 0; // Somatório no totalizador geral

        }

        $totalTransfer = 0;
        foreach ($reserveTransfer as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['reserve_transfer'][$day] = $data['transfer'] ?? 0;
            $totalTransfer += $data['transfer'] ?? 0; // Somatório no totalizador geral

        }

        $report['reserve_exits']['total'] = $totalExits;
        $report['reserve_transfer']['total'] = $totalTransfer;

        $cnes = str_split("0769452");

        return PDF::loadView('reports.monthly.033_samu_basic', compact('report', 'month', 'year', 'cnes'))->setPaper('a4', 'landscape')->download("Report.pdf");
    }

    function monthly_samu_avanced(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $date = $request->month;
        $month = date('m', strtotime($request->month));
        $year = date('Y', strtotime($request->month));

        $report = array();

        //TODA UTILIZACAO DA USA01

        $usa01Exits = Sheet::select(DB::raw("count(*) as exits"), 'created_at as datef') // Não seja trote, interrompida, nem repasse e nem transferência
            ->where('used_transport', 3) // Usa01
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 7, 6])
            ->whereNull('transfer_code')
            // ->whereRaw("month(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $month)
            // ->whereRaw("year(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $year)
            ->whereMonth(DB::raw("created_at"), $month)
            ->whereYear(DB::raw("created_at"), $year)
            ->groupBy('datef')
            ->get();

        $usa01Transfer = Sheet::select(DB::raw("count(*) as transfer"), 'created_at as datef') // Não seja trote, interrompida, nem repasse e nem transferência
            ->where('used_transport', 3)
            ->whereNull('deleted_at')
            ->whereNotNull('transfer_code')
            // ->whereRaw("month(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $month)
            // ->whereRaw("year(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $year)
            ->whereMonth(DB::raw("created_at"), $month)
            ->whereYear(DB::raw("created_at"), $year)
            ->groupBy('datef')
            ->get();

        $totalExits = 0;
        $report['usa01_exits'] = array_fill_keys(range(1, 31), 0);
        $report['usa01_transfer'] = array_fill_keys(range(1, 31), 0);

        foreach ($usa01Exits as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['usa01_exits'][$day] += $data['exits'] ?? 0;
            $totalExits += $data['exits'] ?? 0; // Somatório no totalizador geral

        }

        $totalTransfer = 0;
        foreach ($usa01Transfer as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['usa01_transfer'][$day] += $data['transfer'] ?? 0;
            $totalTransfer += $data['transfer'] ?? 0; // Somatório no totalizador geral

        }

        $report['usa01_exits']['total'] = $totalExits;
        $report['usa01_transfer']['total'] = $totalTransfer;

        $cnes = str_split("6965490");

        return PDF::loadView('reports.monthly.031_avanced_support', compact('report', 'month', 'year', 'cnes'))->setPaper('a4', 'landscape')->download("Report.pdf");
    }

    function monthly_samu_avanced_2(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response(['status' => "error", 'data' => "", 'message' => $validator->errors()->all()], 400);
        }

        $date = $request->month;
        $month = date('m', strtotime($request->month));
        $year = date('Y', strtotime($request->month));

        $report = array();

        //TODA UTILIZACAO DA USA02

        $usa02Exits = Sheet::select(DB::raw("count(*) as exits"), 'created_at as datef') // Não seja trote, interrompida, nem repasse e nem transferência
            ->where('used_transport', 4) // Usa01
            ->whereNull('deleted_at')
            ->whereNotIn('status_id', [4, 5, 7, 6])
            ->whereNull('transfer_code')
            // ->whereRaw("month(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $month)
            // ->whereRaw("year(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $year)
            // ->groupBy('created_at')
            ->whereMonth(DB::raw("created_at"), $month)
            ->whereYear(DB::raw("created_at"), $year)
            ->groupBy('datef')
            ->get();

        $usa02Transfer = Sheet::select(DB::raw("count(*) as transfer"), 'created_at as datef') // Não seja trote, interrompida, nem repasse e nem transferência
            ->where('used_transport', 4)
            ->whereNull('deleted_at')
            ->whereNotNull('transfer_code')
            // ->whereRaw("month(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $month)
            // ->whereRaw("year(date(CONVERT_TZ(created_at,@@session.time_zone,@@global.time_zone)))", $year)
            // ->groupBy('created_at')
            ->whereMonth(DB::raw("created_at"), $month)
            ->whereYear(DB::raw("created_at"), $year)
            ->groupBy('datef')
            ->get();
        $report['usa02_exits'] = array_fill_keys(range(1, 31), 0);
        $report['usa02_transfer'] = array_fill_keys(range(1, 31), 0);

        $totalExits = 0;
        foreach ($usa02Exits as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['usa02_exits'][$day] += $data['exits'] ?? 0;
            $totalExits += $data['exits'] ?? 0; // Somatório no totalizador geral

        }

        $totalTransfer = 0;
        foreach ($usa02Transfer as $data) {

            $day = intval(date('d', strtotime($data->datef))); // transforma a data em index

            $report['usa02_transfer'][$day] += $data['transfer'] ?? 0;
            $totalTransfer += $data['transfer'] ?? 0; // Somatório no totalizador geral

        }

        $report['usa02_exits']['total'] = $totalExits;
        $report['usa02_transfer']['total'] = $totalTransfer;

        $cnes = str_split("6965539");

        return PDF::loadView('reports.monthly.032_avanced_support', compact('report', 'month', 'year', 'cnes'))->setPaper('a4', 'landscape')->download("Report.pdf");
    }
}
