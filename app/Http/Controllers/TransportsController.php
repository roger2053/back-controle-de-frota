<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Exception;
use Illuminate\Http\Request;

class TransportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $transports = Transport::all();

            return response(['status' => 'success', 'total' => sizeof($transports), 'data' => $transports], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os Transportes! \n $error_message"], 400);
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
        $transports = Transport::create($request->all());

        $transports = json_decode($transports);

        return response(['status' => "success", 'data' => $transports, 'message' => "Transporte cadastrado com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transports = Transport::find($id);

        if (!$transports) {
            return response(['status' => "error", 'data' => "", 'message' => "Transporte não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $transports, 'message' => ""], 200);
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
        $transports = Transport::find($id);

        if (!$transports) {
            return response(['status' => "error", 'data' => "", 'message' => "Transporte não encontrado!"], 404);
        } else {

            $request = $request->all();

            $transports->update($request);

            return response(['status' => "success", 'data' => $transports, 'message' => "Transporte atualizado com sucesso!"], 200);
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
        $transports = Transport::find($id);

        if (!$transports) {
            return response(['status' => "error", 'data' => "", 'message' => "Transporte não encontrado!"], 404);
        } else {
            try {
                $transports->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Transporte excluído oom sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o Transporte! \n $err"], 400);
            }
        }
    }
}
