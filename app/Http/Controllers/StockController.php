<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stock\AddRequest;
use App\Http\Services\StockService;
use App\Models\City;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StockController extends Controller
{

    private $service;
    public function __construct(StockService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            return $this->success($this->service->index($request->query->all()));
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            return $this->success($this->service->store($request->all()), 'Criado com sucesso', 201);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }

    public function show($id)
    {
        try {
            return $this->success($this->service->show($id), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            return $this->success($this->service->updateStock($request->all(), $id), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }


    public function destroy($id)
    {
        try {
            return $this->success($this->service->destroy($id), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }


    public function withDrawn(Request $request, $id)
    {
        try {
            // return $this->success($this->service->withDrawn($request->all(), $id), 'Sucesso', 200);
            $params = $this->service->withDrawn($request->all(), $id);
            return Pdf::loadView('stock.stocksheet', compact('params'))->download("Ficha de Baixa.pdf");

        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }

    public function withDrawnMulti(Request $request)
    {
        try {
            // return $this->success($this->service->withDrawn($request->all(), $id), 'Sucesso', 200);
            $params = $this->service->withDrawnMulti($request->all());
            // dd($params);
            return Pdf::loadView('stock.multistocksheet', compact('params'))->download("Ficha de Baixa.pdf");

        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }
    public function getAllStock()
    {
        try {
            return $this->success($this->service->getAllStock(), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }
    public function addStock(AddRequest $request, $id)
    {
        try {
            return $this->success($this->service->addStock($request->all(), $id), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }
    public function getAdds($id)
    {
        try {
            return $this->success($this->service->getAdds($id), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }
    public function getAddComponents($id)
    {
        try {
            return $this->success($this->service->getAddComponents($id), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }
    public function extractStock(Request $request, $id)
    {
        try {
            return $this->success($this->service->history($id), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }

    public function getTop50(Request $request)
    {
        try {
            return $this->success($this->service->getTop50(), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }


    public function getReports(Request $request)
    {
        try {
            return $this->success($this->service->getReports($request->query->all()), 'Sucesso', 200);
        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }

    public function pdfReportById(Request $request, $id)
    {
        try {
            $params = $this->service->pdfReportById($id);
            return Pdf::loadView('stock.multistocksheet', compact('params'))->download("Ficha de Baixa.pdf");

        } catch (Exception $err) {
            $error_message = $err->getMessage();
            return $this->error(['status' => "error", 'data' => "", 'message' => "Ocorreu um erro ao retornar os produtos do estoque! \n $error_message"], 500);
        }
    }

}
