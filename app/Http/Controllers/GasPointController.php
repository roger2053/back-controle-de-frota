<?php

namespace App\Http\Controllers;

use App\Models\GasPoint;
use Exception;
use Illuminate\Http\Request;

class GasPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $gasPoints = GasPoint::select('id', 'name', 'district', 'street', 'number', 'city', 'state', 'phone')->get();

            return response(['status' => 'success', 'total' => sizeof($gasPoints), 'data' => $gasPoints], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os Postos de Combustível! \n $error_message"], 400);
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
        $gasPoint = GasPoint::create($request->all());

        $gasPoint = json_decode($gasPoint);

        return response(['status' => "success", 'data' => $gasPoint, 'message' => "Posto de Combustível cadastrado com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gasPoint = GasPoint::find($id);

        if (!$gasPoint) {
            return response(['status' => "error", 'data' => "", 'message' => "Posto de Combustível não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $gasPoint, 'message' => ""], 200);
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
        $gasPoint = GasPoint::find($id);

        if (!$gasPoint) {
            return response(['status' => "error", 'data' => "", 'message' => "Posto de Combustível não encontrado!"], 404);
        } else {

            $request = $request->all();

            $gasPoint->update($request);

            return response(['status' => "success", 'data' => $gasPoint, 'message' => "Posto de Combustível atualizado com sucesso!"], 200);
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
        $gasPoint = GasPoint::find($id);

        if (!$gasPoint) {
            return response(['status' => "error", 'data' => "", 'message' => "Posto de Combustível não encontrado!"], 404);
        } else {
            try {
                $gasPoint->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Posto de Combustível excluído com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o Posto de Combustível! \n $error_message"], 400);
            }
        }
    }
}
