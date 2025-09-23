<?php

namespace App\Http\Controllers;

use App\Models\EmergencyType;
use Exception;
use Illuminate\Http\Request;

class EmergencyTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function emergency_type_by_emergency_id($emergency_id)
    {
        try {

            $emergency_types = EmergencyType::where("emergency_id", $emergency_id)->orderBy('emergency_type')->get();

            return response(['status' => 'success', 'total' => sizeof($emergency_types), 'data' => $emergency_types], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os tipos de emergência! \n $error_message"], 400);
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
        $emergency_types = EmergencyType::create($request->all());

        $emergency_types = json_decode($emergency_types);

        return response(['status' => "success", 'data' => $emergency_types, 'message' => "Tipo de Emergência cadastrado com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emergency_types = EmergencyType::find($id);

        if (!$emergency_types) {
            return response(['status' => "error", 'data' => "", 'message' => "Tipo de Emergência não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $emergency_types, 'message' => ""], 200);
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
        $emergency_types = EmergencyType::find($id);

        if (!$emergency_types) {
            return response(['status' => "error", 'data' => "", 'message' => "Tipo de Emergência não encontrado!"], 404);
        } else {

            $request = $request->all();

            $emergency_types->update($request);

            return response(['status' => "success", 'data' => $emergency_types, 'message' => "Tipo de Emergência atualizado com sucesso!"], 200);
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
        $emergency_types = EmergencyType::find($id);

        if (!$emergency_types) {
            return response(['status' => "error", 'data' => "", 'message' => "Tipo de Emergência não encontrado!"], 404);
        } else {
            try {
                $emergency_types->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Tipo de Emergência excluído com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o tipo da Emergência! \n $error_message"], 400);
            }
        }
    }
}
