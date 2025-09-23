<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
    public function login(Request $request)
    {

        $credentials = [
            'email'      =>  $request->email,
            'password' => $request->password,
        ];
        if (!JWTAuth::attempt($credentials)) {
            return response()->json(['status' => "error", 'message' => "Dados de login inválidos"], 404);
        }
        $token = $this->respondWithToken(JWTAuth::attempt($credentials));
        // $user = User::select('*')
        // ->where('email', $request->email)
        // ->where('password', md5($request->password))
        // ->first();
        
        $user = User::where('email', $request->email)->first();
        $user->token = $token['access_token'];

        $user_data = new \stdClass();
        $user_data->id = $user->id;
        $user_data->name = $user->name;
        $user_data->profile_id = $user->profile_id;
        $user_data->email = $user->email;

        return response(['status' => "success", 'token' => $user->token, 'user' => $user_data, 'message' => "Seja bem vindo(a)!"], 200);
    }
}
