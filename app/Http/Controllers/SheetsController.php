<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hospital;
use App\Models\Sheet;
use App\Models\Transport;
use App\Models\User;
use App\Models\Victim;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class SheetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();

            $start = $start_date->addHours(3)->toDateTimeString();
            $end = $end_date->addHours(3)->toDateTimeString();

            // Parâmetros de paginação e busca
            $perPage = $request->get('per_page', 50);
            $page = $request->get('page', 1);
            $search = $request->get('search', '');

            // Query base
            $query = Sheet::leftJoin('users', 'users.id', 'sheets.user_id')
                ->leftJoin('cities', 'cities.id', 'sheets.patient_city')
                ->leftJoin('severities', 'severities.id', 'sheets.severity_id')
                ->leftJoin('statuses', 'statuses.id', 'sheets.status_id')
                ->leftJoin('transports', 'transports.id', 'sheets.used_transport')
                ->select('sheets.user_id', 'sheets.protocol', 'sheets.requester_name', 'sheets.requester_contact', 'sheets.complaint', 'sheets.created_at', 'severities.severity', 'cities.city', 'transports.transport as used_transport', 'statuses.status')
                ->when(!empty($request->start_date) && !empty($request->end_date), function ($q) use ($start, $end) {
                    return $q->whereBetween('sheets.created_at', [$start, $end]);
                })
                ->when(!empty($request->doctors), function ($q) use ($request) {
                    return $q->whereIn('users.id', explode(',', $request->doctors));
                })
                ->orderBy('sheets.protocol', 'DESC');

            // Aplicar busca se fornecida
            if (!empty($search)) {
                // Obtém os protocolos de fichas que contêm vítimas com o nome buscado
                $victimProtocols = Victim::where('name', 'LIKE', '%' . $search . '%')->orWhere('complaint', 'LIKE', '%' . $search . '%')
                    ->pluck('sheet_protocol')
                    ->toArray();

                $query->where(function ($q) use ($search, $victimProtocols) {
                    $q->where('sheets.protocol', 'LIKE', '%' . $search . '%')
                        ->orWhere('sheets.requester_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('sheets.requester_contact', 'LIKE', '%' . $search . '%')
                        ->orWhere('severities.severity', 'LIKE', '%' . $search . '%')
                        ->orWhere('transports.transport', 'LIKE', '%' . $search . '%')
                        ->orWhere('cities.city', 'LIKE', '%' . $search . '%')
                        ->orWhere('users.name', 'LIKE', '%' . $search . '%')
                        ->orWhereIn('sheets.protocol', $victimProtocols);
                });
            }

            // Aplicar paginação
            $sheets = $query->paginate($perPage, ['*'], 'page', $page);
            $sheetsData = $sheets->items();

            foreach ($sheetsData as $sheet) {
                $patients = Victim::select('name', 'complaint', 'contact', 'age_group', 'age', 'is_month', 'evolution')
                    ->where("sheet_protocol", $sheet->protocol)
                    ->orderBy('id', 'ASC')
                    ->get();

                $patient = [
                    'name' => null,
                    'complaint' => null,
                    'contact' => null,
                    'age_group' => "",
                    'age' => null,
                    'is_month' => false,
                    'evolution' => null
                ];

                foreach ($patients as $person) {
                    $patient['name'] .= $person->name ? (empty($patient['name']) ? $person->name : ", " . $person->name) : null;
                    $patient['complaint'] .= $person->complaint ? (empty($patient['complaint']) ? $person->complaint : ", " . $person->complaint) : null;
                    $patient['contact'] .= $person->contact ? (empty($patient['contact']) ? $person->contact : ", " . $person->contact) : null;

                    if ($person['age_group']) {
                        if ($person['age_group'] == 'RN') {
                            $sheet->patient_age = $person['age'] . ($person['age'] > 1 ? " Dias" : " Dia");
                        } else if ($person['age_group'] == 'Criança') {
                            if ($person['is_month'] == true) {
                                $age = ($person['age'] > 1 ? " Meses" : " Mês");
                            } else {
                                $age = ($person['age'] > 1 ? " Anos" : " Ano");
                            }
                            $sheet->patient_age = $person['age'] . $age;
                        } else {
                            $age = ($person['age'] > 1 ? " Anos" : " Ano");
                            $sheet->patient_age = $person['age'] . $age;
                        }
                    } else if (empty($person['age'])) {
                        $sheet->patient_age = "Indefinido";
                    } else {
                        $age = ($person['age'] > 1 ? " Anos" : " Ano");
                        $sheet->patient_age = $person['age'] . $age;
                    }
                    // Campo para mostrar que a ficha foi avaliada
                    if (!empty($person->evolution)) {
                        $sheet->is_evaluated = true;
                    }
                    $patient['age'] = $person['age'];
                }

                if ($patient) {
                    $sheet->patient_name = $patient['name'];
                    $sheet->complaint = $patient['complaint'];
                    $sheet->patient_contact = $patient['contact'];

                    // if ($patient['age_group']) {
                    //     if ($patient['age_group'] == 'RN') {
                    //         $sheet->patient_age = $patient['age'] . ($patient['age'] > 1 ? " Dias" : " Dia");
                    //     } else if ($patient['age_group'] == 'Criança') {
                    //         if ($patient['is_month'] == true) {
                    //             $age = ($patient['age'] > 1 ? " Meses" : " Mês");
                    //         } else {
                    //             $age = ($patient['age'] > 1 ? " Anos" : " Ano");
                    //         }
                    //         $sheet->patient_age = $patient['age'] . $age;
                    //     } else {
                    //         $age = ($patient['age'] > 1 ? " Anos" : " Ano");
                    //         $sheet->patient_age = $patient['age'] . $age;
                    //     }
                    // } else if (empty($patient['age'])) {
                    //     $sheet->patient_age = "Indefinido";
                    // } else {
                    //     $age = ($patient['age'] > 1 ? " Anos" : " Ano");
                    //     $sheet->patient_age = $patient['age'] . $age;
                    // }
                    // // Campo para mostrar que a ficha foi avaliada
                    // if (!empty($patient->evolution)) {
                    //     $sheet->is_evaluated = true;
                    // }
                } else {
                    $sheet->patient_name = null;
                    $sheet->complaint = null;
                    $sheet->patient_contact = null;
                    $sheet->patient_age = null;
                }

                // Obtém o nome do Técnico
                if ($sheet->user_id) {
                    $user = User::select('crm', 'name')->find($sheet->user_id);
                    if ($user) {
                        $sheet->user = $user->crm . " - " . $user->name;
                    } else {
                        $sheet->user = "";
                    }
                }
                $sheet->created_at_formated = date('d/m/Y H:i:s', strtotime($sheet->created_at . ' - 3 hours'));
            }

            // Remove a coluna doctor_id
            foreach ($sheetsData as $sheet) {
                unset($sheet->doctor_id);
            }

            return response([
                'status' => 'success',
                'total' => $sheets->total(),
                'current_page' => $sheets->currentPage(),
                'last_page' => $sheets->lastPage(),
                'per_page' => $sheets->perPage(),
                'data' => $sheetsData
            ], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar as fichas! \n $error_message"], 400);
        }
    }

    /**
     * Display a listing of the resource deleted.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteds()
    {
        try {

            $sheets = Sheet::leftJoin('users', 'users.id', 'sheets.user_id')
                ->leftJoin('cities', 'cities.id', 'sheets.patient_city')
                ->leftJoin('severities', 'severities.id', 'sheets.severity_id')
                ->leftJoin('statuses', 'statuses.id', 'sheets.status_id')
                ->leftJoin('transports', 'transports.id', 'sheets.used_transport')
                ->select('sheets.doctor_id', 'sheets.is_evaluated', 'sheets.protocol', 'sheets.requester_name', 'sheets.requester_contact', 'sheets.complaint', 'sheets.created_at', 'sheets.deleted_at', 'sheets.deleted_by_id', 'sheets.deleted_by_name', 'severities.severity', 'cities.city', 'transports.transport as used_transport', 'statuses.status')
                ->orderBy('sheets.protocol', 'DESC')
                ->whereNotNull('sheets.deleted_at')
                ->withTrashed()
                ->get();

            foreach ($sheets as $sheet) {

                $patient = Victim::select('name', 'complaint', 'contact', 'age_group', 'age')->where("sheet_protocol", $sheet->protocol)->orderBy('id', 'ASC')->get();

                if (sizeof($patient) > 0) {
                    $sheet->patient_name = $patient[0]['name'];
                    $sheet->complaint = $patient[0]['complaint'];
                    $sheet->patient_contact = $patient[0]['contact'];
                    $sheet->patient_age = $patient[0]['age'];

                    $sheet->patient_age =
                        $patient[0]['age_group'] && $patient[0]['age_group'] == 'RN' ?
                        ($patient[0]['age'] == 1 ? $patient[0]['age'] . " Mês" : $patient[0]['age'] . " Meses") : ($patient[0]['age'] == 1 ? $patient[0]['age'] . " Ano" : $patient[0]['age'] . " Anos");
                } else {
                    $sheet->patient_name = null;
                    $sheet->complaint = null;
                    $sheet->patient_contact = null;
                    $sheet->patient_age = null;
                }

                // Obtém o nome do médico
                if ($sheet->doctor_id) {
                    $doctor = User::select('crm', 'name')->find($sheet->doctor_id);
                    $sheet->doctor = $doctor->crm . " - " . $doctor->name;
                }
            }

            // Remove a coluna doctor_id
            foreach ($sheets as $sheet) {
                unset($sheet->doctor_id);
            }

            return response(['status' => 'success', 'total' => sizeof($sheets), 'data' => $sheets], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar as fichas! \n $error_message"], 400);
        }
    }

    /**
     * Restore a resource deleted
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($protocol)
    {
        try {

            $sheets = Sheet::where('protocol', $protocol)->withTrashed()->first();

            if (!$sheets) {
                return response(['status' => "error", 'data' => "", 'message' => "Ficha não encontrada!"], 404);
            } else {

                $sheets['deleted_at'] = null;
                $sheets['deleted_by_id'] = null;
                $sheets['deleted_by_name'] = null;

                $sheets->save();

                return response(['status' => "success", 'data' => $sheets, 'message' => "Ficha $protocol restaurada com sucesso!"], 200);
            }
        } catch (Exception $e) {

            return response(['status' => "error", 'data' => "", 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {

            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $end_date = Carbon::parse($request->end_date)->endOfDay();

            $start = $start_date->addHours(3)->toDateTimeString();
            $end = $end_date->addHours(3)->toDateTimeString();

            $sheets = Sheet::leftJoin('users', 'users.id', 'sheets.user_id')
                ->leftJoin('cities', 'cities.id', 'sheets.patient_city')
                ->leftJoin('severities', 'severities.id', 'sheets.severity_id')
                ->leftJoin('statuses', 'statuses.id', 'sheets.status_id')
                ->leftJoin('transports', 'transports.id', 'sheets.used_transport')
                ->select('sheets.doctor_id', 'sheets.protocol', 'sheets.requester_name', 'sheets.requester_contact', 'sheets.complaint', 'sheets.created_at', 'severities.severity', 'cities.city', 'transports.transport as used_transport', 'statuses.status')
                ->orderBy('sheets.protocol', 'DESC')
                ->whereBetween('sheets.created_at', [$start, $end])
                ->get();

            foreach ($sheets as $sheet) {

                $patient = Victim::select('name', 'complaint', 'contact', 'age_group', 'age', 'is_month', 'evolution')->where("sheet_protocol", $sheet->protocol)->orderBy('id', 'ASC')->first();

                // if (sizeof($patient) > 0) {
                //     $sheet->patient_name = $patient[0]['name'];
                //     $sheet->complaint = $patient[0]['complaint'];
                //     $sheet->patient_contact = $patient[0]['contact'];
                //     $sheet->patient_age = $patient[0]['age'];

                //     $sheet->patient_age =
                //         $patient[0]['age_group'] && $patient[0]['age_group'] == 'RN' ?
                //         ($patient[0]['age'] == 1 ? $patient[0]['age'] . " Mês" : $patient[0]['age'] . " Meses") : ($patient[0]['age'] == 1 ? $patient[0]['age'] . " Ano" : $patient[0]['age'] . " Anos");
                // } else {
                //     $sheet->patient_name = null;
                //     $sheet->complaint = null;
                //     $sheet->patient_contact = null;
                //     $sheet->patient_age = null;
                // }

                // // Obtém o nome do médico
                // if ($sheet->doctor_id) {
                //     $doctor = User::select('crm', 'name')->find($sheet->doctor_id);

                //     if ($doctor) {
                //         $sheet->doctor = $doctor->crm . " - " . $doctor->name;
                //     } else {
                //         $sheet->doctor = "";
                //     }
                // }

                // if (!empty($patient->evolution)) {
                //     $sheet->is_evaluated = true;
                // }
                // $sheet->created_at_formated = date('d/m/Y H:i:s', strtotime($sheet->created_at . ' - 3 hours'));
                if ($patient) {
                    $sheet->patient_name = $patient['name'];
                    $sheet->complaint = $patient['complaint'];
                    $sheet->patient_contact = $patient['contact'];

                    if ($patient['age_group']) {
                        if ($patient['age_group'] == 'RN') {
                            $sheet->patient_age = $patient['age'] . ($patient['age'] > 1 ? " Dias" : " Dia");
                        } else if ($patient['age_group'] == 'Criança') {
                            if ($patient['is_month'] == true) {
                                $age = ($patient['age'] > 1 ? " Meses" : " Mês");
                            } else {
                                $age = ($patient['age'] > 1 ? " Anos" : " Ano");
                            }
                            $sheet->patient_age = $patient['age'] . $age;
                        } else {
                            $age = ($patient['age'] > 1 ? " Anos" : " Ano");
                            $sheet->patient_age = $patient['age'] . $age;
                        }
                    } else if (empty($patient['age'])) {
                        $sheet->patient_age = "Indefinido";
                    } else {

                        $age = ($patient['age'] > 1 ? " Anos" : " Ano");
                        $sheet->patient_age = $patient['age'] . $age;
                    }
                    // Campo para mostrar que a ficha foi avaliada
                    if (!empty($patient->evolution)) {
                        $sheet->is_evaluated = true;
                    }
                } else {
                    $sheet->patient_name = null;
                    $sheet->complaint = null;
                    $sheet->patient_contact = null;
                    $sheet->patient_age = null;
                }

                // Obtém o nome do médico
                if ($sheet->doctor_id) {
                    $doctor = User::select('crm', 'name')->find($sheet->doctor_id);
                    if ($doctor) {
                        $sheet->doctor = $doctor->crm . " - " . $doctor->name;
                    } else {
                        $sheet->doctor = "";
                    }
                }
                $sheet->created_at_formated = date('d/m/Y H:i:s', strtotime($sheet->created_at . ' - 3 hours'));
            }

            // Remove a coluna doctor_id
            foreach ($sheets as $sheet) {
                unset($sheet->doctor_id);
            }

            return response(['status' => 'success', 'total' => sizeof($sheets), 'data' => $sheets], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar as fichas! \n $error_message"], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function make_pdf($id)
    {

        $sheets = Sheet::leftJoin('users', 'users.id', 'sheets.user_id')
            ->leftJoin('emergencies', 'emergencies.id', 'sheets.emergency_id')
            ->leftJoin('emergency_types', 'emergency_types.id', 'sheets.emergency_type_id')
            ->leftJoin('cities', 'cities.id', 'sheets.patient_city')
            ->leftJoin('severities', 'severities.id', 'sheets.severity_id')
            ->leftJoin('hospitals', 'hospitals.id', 'sheets.hospital_id')
            ->leftJoin('locales', 'locales.id', 'sheets.patient_locale')
            ->leftJoin('transports', 'transports.id', 'sheets.used_transport')
            ->leftJoin('teams', 'teams.id', 'sheets.used_transport_team')
            ->leftJoin('statuses', 'statuses.id', 'sheets.status_id')
            ->select(
                'sheets.*',
                'users.service_base',
                'emergencies.emergency',
                'emergency_types.emergency_type',
                'cities.city',
                'severities.severity',
                'hospitals.name as hospital',
                'locales.locale',
                'transports.transport',
                'teams.team',
                'statuses.status',
            )
            ->where('sheets.protocol', $id)
            ->orderBy('sheets.protocol', 'DESC')
            ->first();

        $victims = Victim::leftJoin('emergencies', 'emergencies.id', 'victims.emergency_id')
            ->leftJoin('emergency_types', 'emergency_types.id', 'victims.emergency_type_id')
            ->leftJoin('severities', 'severities.id', 'victims.severity_id')
            ->select(
                'victims.*',
                'emergencies.emergency',
                'emergency_types.emergency_type',
                'severities.severity',
            )
            ->where('sheet_protocol', $id)->get();

        // print_r($sheets); die();

        // Obtém o nome do médico
        $doctor = User::select('name', 'signature', 'crm')->find($sheets->doctor_id);

        $sheets->doctor = $doctor->name ?? '';

        if (!empty($doctor->signature)) {
            $img_path = url('') . "/storage/" . $doctor->signature;
            $extension = pathinfo($img_path, PATHINFO_EXTENSION);
            $data = FacadesStorage::disk('public')->get($doctor->signature);
            $img_base_64 = base64_encode($data);
            $sheets->doctor_signature = 'data:image/' . $extension . ';base64,' . $img_base_64;
            $sheets->doctor_crm = $doctor->crm;
        }

        unset($sheets->doctor_id);

        // Obtém o local de partida da transferência
        if ($sheets->transfer_origin == 28) $sheets->transfer_origin = $sheets->other_transfer_origin;
        else {
            $sheets->transfer_origin = $sheets->transfer_origin != null ? Hospital::select('name')->find($sheets->transfer_origin)['name'] : null;
        }

        // Obtém o local de destino da transferência
        if ($sheets->transfer_destiny == 28) $sheets->transfer_destiny = $sheets->other_transfer_destiny;
        else {
            $sheets->transfer_destiny = $sheets->transfer_destiny != null ? Hospital::select('name')->find($sheets->transfer_destiny)['name'] : null;
        }

        if ($sheets->hospital_id == 28) $sheets->hospital_destiny = $sheets->other_hospital;
        else {
            $sheets->hospital_destiny = $sheets->hospital_id != null ? Hospital::select('name')->find($sheets->hospital_id)['name'] : null;
        }

        // Obtém o transporte utilizado na transferência
        $sheets->transfer_used_transport = $sheets->transfer_used_transport != null ? Transport::select('transport')->find($sheets->transfer_used_transport)['transport'] : null;

        // Obtém o transporte utilizado na transferência
        $sheets->used_transport_team = $sheets->used_transport_team != null ? Transport::select('transport')->find($sheets->used_transport_team)['transport'] : null;

        // Define o transporte utilizado
        $sheets->used_transport = $sheets->transport;
        unset($sheets->transport);

        // Define o transporte utilizado
        $sheets->used_transport_team = $sheets->team;
        unset($sheets->team);

        // Define a cidade do paciente
        $sheets->patient_city = $sheets->city;
        unset($sheets->city);

        // Define o local do paciente
        $sheets->patient_locale = $sheets->locale;
        unset($sheets->locale);

        // Formata a data e hora de entrada para o padrão BR
        $sheets->checkin = date('d/m/Y H:i:s', strtotime('-3 hours', strtotime($sheets->created_at)));

        // Removendo colunas não necessárias
        unset($sheets->emergency_id);
        unset($sheets->emergency_type_id);
        unset($sheets->severity_id);
        unset($sheets->hospital_id);
        unset($sheets->status_id);
        unset($sheets->user_id);

        $created_at = Carbon::parse($sheets->created_at);
        $updated_at = Carbon::parse($sheets->updated_at);
        $diff = $created_at->diff($updated_at);
        $sheets->stopwatch = $diff->format('%H:%I:%S');

        // return \PDF::loadView('reports.sheets.print_sheet', compact('sheets', 'victims'))->download("Ficha $sheets->protocol.pdf");
        return Pdf::loadView('reports.sheets.print_sheet', compact('sheets', 'victims'))->download("Ficha $sheets->protocol.pdf");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->all();

        $request['status_id'] = 1;

        $sheets = Sheet::create($request);

        $sheets = json_decode($sheets);

        return response(['status' => "success", 'data' => $sheets, 'message' => "Ficha cadastrada com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sheets = Sheet::find($id);

        if ($sheets->victims) {
            $victims = $sheets->victims;
            $sheets->victims = $victims;
            $sheets->created_at_formated = date('d/m/Y H:i:s', strtotime($sheets->created_at . ' - 3 hours'));
        }

        if (!$sheets) {
            return response(['status' => "error", 'data' => "", 'message' => "Ficha não encontrada!"], 404);
        } else {
            return response(['status' => "success", 'data' => $sheets, 'message' => ""], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            unset($request['victims']);
            unset($request['created_formated']);
            unset($request['created_at_formated']);
            $sheets = Sheet::find($id);

            if (!$sheets) {

                return response(['status' => "error", 'data' => "", 'message' => "Ficha não encontrada!"], 404);
            } else {

                $request = $request->all();
                // foreach ($request as $key => $param) {

                //     if($key === "used_transport_team" || $key === "used_transport"){
                //         continue;
                //     }

                //     if (empty($param) || is_null($param) ) {
                //         unset($request[$key]);
                //     }
                // }
                $sheets->update($request);

                return response(['status' => "success", 'data' => $sheets, 'message' => "Ficha atualizada com sucesso!"], 200);
            }
        } catch (Exception $e) {

            return response(['status' => "error", 'data' => "", 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $sheets = Sheet::find($id);

        if (!$sheets) {
            return response(['status' => "error", 'data' => "", 'message' => "Ficha não encontrada!"], 404);
        } else {
            try {

                // $user = get_user_data($request);
                $user = JWTAuth::user();

                $user->id = User::select('id')->where('email', $user->email)->first()->id;

                $sheets->deleted_by_id = $user->id;
                $sheets->deleted_by_name = $user->name;
                $sheets->save();

                $sheets->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Ficha excluída com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir a Ficha! \n $error_message"], 400);
            }
        }
    }

    public function jobDateRepair()
    {
        // $sheets = Sheet::where('protocol',170524)->first();
        $sheets = Sheet::whereBetween('created_at', ['2023-02-01', '2023-02-16'])->get();
        foreach ($sheets as $sheet) {
            if ($sheet->protocol != 170540) {

                $sheet->created_at = date('Y-m-d H:i:s', strtotime($sheet->created_at . ' -3 HOURS'));
                $sheet->save();
            }
        }

        return response(['success' => true, 'data' => $sheets], 200);
    }
}
