<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Exception;
use Illuminate\Http\Request;

class HospitalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $hospitals = Hospital::select('id', 'name')->get();

            return response(['status' => 'success', 'total' => sizeof($hospitals), 'data' => $hospitals], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os Hospitais! \n $error_message"], 400);
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
        $hospitals = Hospital::create($request->all());

        $hospitals = json_decode($hospitals);

        return response(['status' => "success", 'data' => $hospitals, 'message' => "Hospital cadastrado com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospitals = Hospital::find($id);

        if (!$hospitals) {
            return response(['status' => "error", 'data' => "", 'message' => "Hospital não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $hospitals, 'message' => ""], 200);
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
        $hospitals = Hospital::find($id);

        if (!$hospitals) {
            return response(['status' => "error", 'data' => "", 'message' => "Hospital não encontrado!"], 404);
        } else {

            $request = $request->all();

            $hospitals->update($request);

            return response(['status' => "success", 'data' => $hospitals, 'message' => "Hospital atualizado com sucesso!"], 200);
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
        $hospitals = Hospital::find($id);

        if (!$hospitals) {
            return response(['status' => "error", 'data' => "", 'message' => "Hospital não encontrado!"], 404);
        } else {
            try {
                $hospitals->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Hospital excluído com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o Hospital! \n $error_message"], 400);
            }
        }
    }
}
