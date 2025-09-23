<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use Exception;
use Illuminate\Http\Request;

class EmergenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $emergencies = Emergency::select('id', 'emergency')->get();

            return response(['status' => 'success', 'total' => sizeof($emergencies), 'data' => $emergencies], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar as emergências! \n $error_message"], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emergencies = Emergency::create($request->all());

        $emergencies = json_decode($emergencies);

        return response(['status' => "success", 'data' => $emergencies, 'message' => "Emergência cadastrada com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emergencies = Emergency::find($id);

        if (!$emergencies) {
            return response(['status' => "error", 'data' => "", 'message' => "Emergência não encontrada!"], 404);
        } else {
            return response(['status' => "success", 'data' => $emergencies, 'message' => ""], 200);
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
        $emergencies = Emergency::find($id);

        if (!$emergencies) {
            return response(['status' => "error", 'data' => "", 'message' => "Emergência não encontrada!"], 404);
        } else {

            $request = $request->all();

            $emergencies->update($request);

            return response(['status' => "success", 'data' => $emergencies, 'message' => "Emergência atualizada com sucesso!"], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emergencies = Emergency::find($id);

        if (!$emergencies) {
            return response(['status' => "error", 'data' => "", 'message' => "Emergência não encontrada!"], 404);
        } else {
            try {
                $emergencies->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Emergência excluída com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir a Emergência! \n $error_message"], 400);
            }
        }
    }
}
