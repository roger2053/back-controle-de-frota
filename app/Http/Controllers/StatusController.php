<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Exception;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $status = Status::all();

            return response(['status' => 'success', 'total' => sizeof($status), 'data' => $status], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os Status! \n $error_message"], 400);
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
        $status = Status::create($request->all());

        $status = json_decode($status);

        return response(['status' => "success", 'data' => $status, 'message' => "Status cadastrado com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Status::find($id);

        if (!$status) {
            return response(['status' => "error", 'data' => "", 'message' => "Status não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $status, 'message' => ""], 200);
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
        $status = Status::find($id);

        if (!$status) {
            return response(['status' => "error", 'data' => "", 'message' => "Status não encontrado!"], 404);
        } else {

            $request = $request->all();

            $status->update($request);

            return response(['status' => "success", 'data' => $status, 'message' => "Status atualizado com sucesso!"], 200);
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
        $status = Status::find($id);

        if (!$status) {
            return response(['status' => "error", 'data' => "", 'message' => "Status não encontrado!"], 404);
        } else {
            try {
                $status->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Status excluído com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o Status! \n $error_message"], 400);
            }
        }
    }
}
