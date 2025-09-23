<?php

namespace App\Http\Controllers;

use App\Models\City;
use Exception;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $cities = City::select('id', 'city')->get();

            return response(['status' => 'success', 'total' => sizeof($cities), 'data' => $cities], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar as Cidades! \n $error_message"], 400);
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
        $cities = City::create($request->all());

        $cities = json_decode($cities);

        return response(['status' => "success", 'data' => $cities, 'message' => "Cidade cadastrada com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cities = City::find($id);

        if (!$cities) {
            return response(['status' => "error", 'data' => "", 'message' => "Cidade não encontrada!"], 404);
        } else {
            return response(['status' => "success", 'data' => $cities, 'message' => ""], 200);
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
        $cities = City::find($id);

        if (!$cities) {
            return response(['status' => "error", 'data' => "", 'message' => "Cidade não encontrada!"], 404);
        } else {

            $request = $request->all();

            $cities->update($request);

            return response(['status' => "success", 'data' => $cities, 'message' => "Cidade atualizada com sucesso!"], 200);
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
        $cities = City::find($id);

        if (!$cities) {
            return response(['status' => "error", 'data' => "", 'message' => "Cidade não encontrada!"], 404);
        } else {
            try {
                $cities->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Cidade excluída com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir a Cidade! \n $error_message"], 400);
            }
        }
    }
}
