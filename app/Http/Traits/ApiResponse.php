<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param $data
     * @param int $status
     * @param string $message
     * @return JsonResponse
     */
    public function success($data = null, string $message = 'Sucesso', int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'response' => $data,
            'message' => $message
        ], $status);
    }

    public function error($data = null, string $message = 'error', int $status = 500): JsonResponse
    {
        return response()->json([
            'status' => false,
            'response' => $data,
            'message' => $message
        ], $status);
    }
}
