<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailToRecoverPassword;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            $users = User::all();

            foreach ($users as $user) {
                $user->created_at_formatted = date('d-m-Y H:i:s', strtotime($user->created_at));
                $user->name = ucwords(strtolower($user->name));
            }

            return response(['status' => 'success', 'total' => sizeof($users), 'data' => $users], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os usuários! \n $error_message"], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_doctors()
    {

        try {

            $doctors = User::select('id', 'crm', 'name')->where('profile_id', '3')->orderBy('name', 'ASC')->get();

            foreach ($doctors as $doctor) {
                $doctor->name = $doctor->crm . " - " . ucwords(strtolower($doctor->name));
            }

            return response(['status' => 'success', 'total' => sizeof($doctors), 'data' => $doctors], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os médicos! \n $error_message"], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_doctor($id)
    {

        try {

            $doctor = User::select('id', 'crm', 'name')->where('profile_id', '3')->where('id', $id)->first();

            return response(['status' => 'success', 'total' => 1, 'data' => $doctor], 200);
        } catch (Exception $err) {
            // Obtém a mensagem de erro
            $error_message = $err->getMessage();

            return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os médicos! \n $error_message"], 400);
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
        $users = User::select('*')
            ->where('email', $request->email)
            ->first();

        if ($users) {
            return response(['status' => "error", 'data' => "", 'message' => "Email $request->email já está em uso!"], 409);
        } else {

            $users = User::create([
                'profile_id' => $request->profile_id,
                'name' => $request->name,
                'crm' => $request->crm,
                'tarm' => $request->tarm,
                'service_base' => $request->service_base,
                'contact' => $request->contact,
                'is_whatsapp' => $request->is_whatsapp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'pin' => $request->pin,
                'personal_email' => $request->personal_email,
                'token' => MakeJwt([
                    'data' => [
                        'iss' => 'samulife',
                        'name' => $request->name,
                        'email' => $request->email
                    ]
                ])
            ]);

            $users = json_decode($users);

            return response(['status' => "success", 'data' => $users, 'message' => "Usuário cadastrado com sucesso!"], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);

        if (!$users) {
            return response(['status' => "error", 'data' => "", 'message' => "Usuário não encontrado!"], 404);
        } else {
            return response(['status' => "success", 'data' => $users, 'message' => ""], 200);
        }
    }

    /**
     * Send mail verification
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmailToRecoverPassword(Request $request)
    {
        $users = User::where("personal_email", $request->personal_email)
            ->first();

        if (!$users) {
            return response(['status' => 'error', 'message' => 'Usuário não encontrado!'], 400);
        } else {
            Mail::to($request->personal_email)->send(new SendEmailToRecoverPassword($users));
            return response(['status' => 'error', 'message' => 'Email de recuperação enviado!'], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recoverMe(Request $request, $id)
    {
        $users = User::where(DB::raw('md5(id)'), $id)->first();

        if (!$users) {
            return response(['status' => "error", 'data' => "", 'message' => "Usuário não encontrado!"], 404);
        } else {

            $request = $request->all();
            unset($request["confirmPassword"]);

            $newPassword = md5($request["password"]);

            $request['user']['password'] = $newPassword;

            $users->update($request['user']);

            return response(['status' => "success", 'data' => $users, 'message' => "Sua senha foi redefinida com sucesso!"], 200);
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
        $users = User::find($id);

        if (!$users) {
            return response(['status' => "error", 'data' => "", 'message' => "Usuário não encontrado!"], 404);
        } else {


            $yourProfile = false;

            $request = $request->all();

            unset($request["user"]["signature"]);

            if ($request["myId"] == $users->id) $yourProfile = true;

            /**
             * Identifica se a senha foi alterada,
             * Se sim, aplica criptografia
             */
            if (isset($request['user']['password'])) {
                // $password = md5($request["user"]["password"]);
                $password = Hash::make($request["user"]["password"]);
            } else {
                $password = $users->password;
            }

            $request["user"]["password"] = $password;


            // $users->token = MakeJwt([
            //     'data' => [
            //         'iss' => 'samulife',
            //         'name' => $request["user"]["name"],
            //         'email' => $request["user"]["email"]
            //     ]
            // ]);

            $users->update($request["user"]);

            return response(['status' => "success", 'yourProfile' => $yourProfile, 'data' => $users, 'newToken' => $users->token, 'message' => "Usuário atualizado com sucesso!"], 200);
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
        $users = User::find($id);

        if (!$users) {
            return response(['status' => "error", 'data' => "", 'message' => "Usuário não encontrado!"], 404);
        } else {
            try {
                $users->delete($id);

                return response(['status' => "success", 'data' => "", 'message' => "Usuário excluído com sucesso!"], 200);
            } catch (Exception $err) {

                // Obtém a mensagem de erro
                $error_message = $err->getMessage();

                return response(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao excluir o usuário! \n $error_message"], 400);
            }
        }
    }

    public function uploadSignature(Request $request, $id)
    {

        $user = User::find($id);

        if ($request->hasFile('signature')) {

            $path = Storage::disk('public')->put('signatures', $request->signature);

            $oldFile = $user->signature;

            $user->signature = $path;

            $user->save();

            Storage::disk('public')->delete($oldFile);

            return response(['status' => "success", 'data' => "", 'message' => "Assinatura enviada com sucesso"], 200);
        }
    }

    public function removeSignature(Request $request, $id)
    {

        $user = User::find($id);

        if (Storage::disk('public')->exists($user->signature)) {
            Storage::disk('public')->delete($user->signature);
        }

        $user->signature = null;

        $user->save();

        return response(['status' => "success", 'message' => "Assinatura removida com sucesso"], 200);
    }

    public function onlines()
    {

        $users =  User::select(
            'users.id',
            'users.id_status',
            'profiles.profile_name as profile',
            'users.name',
            'users.email',
            // DB::raw("DATE_FORMAT(users.last_login, '%d/%m/%Y %H:%i') as last_login")
            "last_login"
        )
            ->leftJoin('profiles', 'profiles.id', '=', 'users.profile_id')
            ->get();

        $currentDateTime = Carbon::now(); // Obter a data e hora atual
        $auth = Auth::user();
        $online = 0;
        foreach ($users as $user) {
            $user->not_to_block = ($auth->id == $user->id) ? true : false;
            if ($user->last_login) {
                $lastLogin = Carbon::parse($user->last_login); // Converter last_login para um objeto Carbon

                // Verificar se a diferença entre o tempo atual e o last_login é menor que 1 minuto (60 segundos)
                if ($currentDateTime->diffInSeconds($lastLogin) < 60) {
                    $user->is_online = true; // Definir is_online como true se a diferença for menor que 1 minuto
                    $online += 1;
                } else {
                    $user->is_online = false; // Caso contrário, definir como false
                }
            } else {
                $user->is_online = null; // Caso contrário, definir como false

            }
        }
        return response(['status' => "success", 'data' => $users, 'online' => $online, 'total' => count($users)], 200);
    }

    public function block(Request $request)
    {
        try {
            $user =  User::where('id', $request->id)->first();
            if ($user->id_status == 1) {
                $user->id_status = 0;
            } else {
                $user->id_status = 1;
            }

            $user->save();
            return response(['status' => "success", 'data' => $user], 200);
        } catch (Exception $e) {
            return response(['status' => "false"], 500);
        }
    }
}
