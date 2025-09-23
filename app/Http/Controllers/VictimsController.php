<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Victim;
use Exception;

class VictimsController extends Controller
{
    public function store(Request $request){

        if(!$request->sheet_protocol){
            return response(['status' => "error", 'message' => "Informe o número da ficha"], 400);
        }

        $victim = $request->victim;
        $victim["sheet_protocol"] = $request->sheet_protocol;

        $response = Victim::create($victim);

        return response(['status' => "success", 'data' => $response, 'message' => "Vitima cadastrada com sucesso!"], 201);

    }

    public function update(Request $request, $id){

        try{
            $victim = Victim::find($id);

            if(!$victim) {
                return response(['status' => "error", 'data' => "", 'message' => "Vítima não encontrada!"], 404);
            }else {
                $request = $request->all();
                $victim->fill($request);
                $victim->save();

                return response(['status' => "success", 'data' => $victim, 'message' => "Vítima atualizada com sucesso!"], 200);
            }
        }catch(Exception $e){
            return response(['status' => "error", 'data' => "", 'message' => $e->getMessage()], 200);
        }

    }

    public function destroy($id)
    {
        $victim = Victim::find($id);

        if (!$victim) {
            return response(['status' => "error", 'data' => "", 'message' => "Vítima não encontrada!"], 404);
        } else {
            try {
                $victim->delete($id);
                return response(['status' => "success", 'data' => "", 'message' => "Vítima excluída com sucesso!"], 200);
            } catch (Exception $err) {

                $error_message = $err->getMessage();
                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir a Vítima! \n $error_message"], 400);
            }
        }
    }
}
