<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Foundation\Auth\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    protected $auth;
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            $user = JWTAuth::user();
            $this->checkOrigin($request, $user);
            if (!$user) {
                JWTAuth::invalidate();
                return response(array('status' => "error", 'message' => "Acesso negado."), 403); // deslogar
            }
            if ($user->id_status != '1') {
                JWTAuth::invalidate();
                return response(array('status' => "error", 'message' => "Seu usuário está bloqueado, entre em contato com o suporte."), 403); // deslogar
            }
            User::where('id', $user->id)->update([
                'last_login' => Carbon::now()
            ]);
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(array('status' => "error", 'message' => $e->getMessage()), 401);
        }
    }

    private function checkOrigin($request, $user)
    {
        if (!is_null($user->origin_type_permission)) {
            $origin = $request->headers->get('X-ORIGIN-REQUEST');
            if ($origin && $user->origin_type_permission != $origin) {
                throw new \Exception('Acesso negado! Você não tem permissão para acessar este recurso.');
            }
        }
    }
}
