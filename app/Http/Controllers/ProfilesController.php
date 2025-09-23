<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $profiles = Profile::all();

            foreach ($profiles as $profile) {
                $profile->permissions = json_decode($profile->permissions);
            }

            return response(['status' => 'success', 'total' => sizeof($profiles), 'data' => $profiles], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os Perfís de Acesso! \n $error_message"], 400);
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
        $request = $request->all();
        $request['permissions'] = json_encode($request['permissions']);

        $profiles = Profile::create($request);

        $profiles = json_decode($profiles);

        return response(['status' => "success", 'data' => $profiles, 'message' => "Perfil de Acesso cadastrado com sucesso!"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profiles = Profile::find($id);

        if ($profiles->permissions == null) {
            $profiles->permissions = json_decode("{}");
        } else {
            $profiles->permissions = json_decode($profiles->permissions);
        }

        if (!$profiles) {
            return response(['status' => "error", 'data' => "", 'message' => "Perfil de Acesso não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $profiles, 'message' => ""], 200);
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
        $profiles = Profile::find($id);

        if (!$profiles) {
            return response(['status' => "error", 'data' => "", 'message' => "Perfil de Acesso não encontrado!"], 404);
        } else {

            $request = $request->all();

            $profiles->update($request);

            return response(['status' => "success", 'data' => $profiles, 'message' => "Perfil de Acesso atualizado com sucesso!"], 200);
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
        $profiles = Profile::find($id);

        if (!$profiles) {
            return response(['status' => "error", 'data' => "", 'message' => "Perfil de Acesso não encontrado!"], 404);
        } else {
            try {
                $profiles->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Perfil de Acesso excluído com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o Perfil de Acesso! \n $error_message"], 400);
            }
        }
    }
}
