<?php

namespace App\Http\Controllers;

use App\Http\Services\NotificationService;
use App\Http\Services\StockService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    private $service;
    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function getAll(Request $request): JsonResponse
    {
        try {
            return $this->success($this->service->getAll());
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar notificações! \n $error_message"], 500);
        }
    }

    public function updateAll(Request $request): JsonResponse
    {
        try {
            return $this->success($this->service->updateAll(),'Atualizado com sucesso',201);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar notificações! \n $error_message"], 500);
        }
    }

}
