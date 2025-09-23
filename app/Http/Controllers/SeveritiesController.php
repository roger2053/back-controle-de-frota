<?php

namespace App\Http\Controllers;

use App\Models\Severity;
use Exception;
use Illuminate\Http\Request;

class SeveritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $severities = Severity::select('id', 'severity')->get();

            return response(['status' => 'success', 'total' => sizeof($severities), 'data' => $severities], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar as Gravidades! \n $error_message"], 400);
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
        $severities = Severity::create($request->all());

        $severities = json_decode($severities);

        return response(['status' => "success", 'data' => $severities, 'message' => "Gravidade cadastrada com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $severities = Severity::find($id);

        if (!$severities) {
            return response(['status' => "error", 'data' => "", 'message' => "Gravidade não encontrada!"], 404);
        } else {
            return response(['status' => "success", 'data' => $severities, 'message' => ""], 200);
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
        $severities = Severity::find($id);

        if (!$severities) {
            return response(['status' => "error", 'data' => "", 'message' => "Gravidade não encontrada!"], 404);
        } else {

            $request = $request->all();

            $severities->update($request);

            return response(['status' => "success", 'data' => $severities, 'message' => "Gravidade atualizada com sucesso!"], 200);
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
        $severities = Severity::find($id);

        if (!$severities) {
            return response(['status' => "error", 'data' => "", 'message' => "Gravidade não encontrada!"], 404);
        } else {
            try {
                $severities->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Gravidade excluída com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir a Gravidade! \n $error_message"], 400);
            }
        }
    }
}
