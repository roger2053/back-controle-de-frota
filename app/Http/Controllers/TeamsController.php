<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $teams = Team::select('id', 'team')->get();

            return response(['status' => 'success', 'total' => sizeof($teams), 'data' => $teams], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar as Equipes! \n $error_message"], 400);
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
        $teams = Team::create($request->all());

        $teams = json_decode($teams);

        return response(['status' => "success", 'data' => $teams, 'message' => "Equipe cadastrada com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teams = Team::find($id);

        if (!$teams) {
            return response(['status' => "error", 'data' => "", 'message' => "Equipe não encontrada!"], 404);
        } else {
            return response(['status' => "success", 'data' => $teams, 'message' => ""], 200);
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
        $teams = Team::find($id);

        if (!$teams) {
            return response(['status' => "error", 'data' => "", 'message' => "Equipe não encontrada!"], 404);
        } else {

            $request = $request->all();

            $teams->update($request);

            return response(['status' => "success", 'data' => $teams, 'message' => "Equipe atualizada com sucesso!"], 200);
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
        $teams = Team::find($id);

        if (!$teams) {
            return response(['status' => "error", 'data' => "", 'message' => "Equipe não encontrada!"], 404);
        } else {
            try {
                $teams->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Equipe excluída com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir a Equipe! \n $error_message"], 400);
            }
        }
    }
}
