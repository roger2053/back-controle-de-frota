<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use Exception;
use Illuminate\Http\Request;

class LocalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $locales = Locale::select('id', 'locale')->get();

            return response(['status' => 'success', 'total' => sizeof($locales), 'data' => $locales], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os Locais! \n $error_message"], 400);
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
        $locales = Locale::create($request->all());

        $locales = json_decode($locales);

        return response(['status' => "success", 'data' => $locales, 'message' => "Local cadastrado com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locales = Locale::find($id);

        if (!$locales) {
            return response(['status' => "error", 'data' => "", 'message' => "Local não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $locales, 'message' => ""], 200);
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
        $locales = Locale::find($id);

        if (!$locales) {
            return response(['status' => "error", 'data' => "", 'message' => "Local não encontrado!"], 404);
        } else {

            $request = $request->all();

            $locales->update($request);

            return response(['status' => "success", 'data' => $locales, 'message' => "Local atualizado com sucesso!"], 200);
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
        $locales = Locale::find($id);

        if (!$locales) {
            return response(['status' => "error", 'data' => "", 'message' => "Local não encontrado!"], 404);
        } else {
            try {
                $locales->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Local excluído com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o Local! \n $error_message"], 400);
            }
        }
    }
}
