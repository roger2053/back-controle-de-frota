<?php

namespace App\Http\Services;

use App\Http\Repositories\Stock\ReportsRepository;
use App\Http\Repositories\Stock\StockRepository;
use App\Models\City;
use App\Models\Transport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class StockService
{

    private $repository;
    private $reportsRepository;
    public function __construct(StockRepository $repository, ReportsRepository $reportsRepository)
    {
        $this->repository = $repository;
        $this->reportsRepository = $reportsRepository;
    }

    private function stockHandler($params)
    {
        if ($params['type'] != 'M' && !empty($params['expiration_date'])) {
            $params['expiration_date'] = null;
        }

        if (!empty($params['measure_value'])) {
            $params['measure_value'] = str_replace(",", ".", $params['measure_value']);
        }

        return $params;
    }

    public function index($params)
    {
        return $this->repository->index($params);
    }


    public function store($params)
    {
        $params = $this->stockHandler($params);
        if(!isset($params['is_controlled'])){
            $params['is_controlled'] = 0;
        }
        $params['stock_quantity'] = 0;
        return $this->repository->store($params);
    }


    public function show($id)
    {
        return $this->repository->show($id);
    }


    public function updateStock($params, $id)
    {
        $params = $this->stockHandler($params);

        return $this->repository->updateStock($params, $id);
    }


    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    public function getAllStock()
    {
        return $this->repository->getAllStock();
    }

    public function withDrawn($params, $id)
    {
        DB::beginTransaction();
        try {
            $this->addUsedQuantity($id, $params['add_id'], $params['quantity_withdrawn']);
            $stock = $this->repository->show($id);

            if (empty($stock)) {
                throw new Exception('Produto não encontrado');
            }

            $data = [
                'stock_quantity' => $stock->stock_quantity - intval($params['quantity_withdrawn']),
                'last_destination' => $params['destination_id'],
                'last_withdrawn' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $this->repository->updateStock($data, $id);

            $withDrawn = [
                'stock_id' => $stock->id,
                'user_id' => Auth::id(),
                'destination_id' => $params['destination_id'],
                'cpf' => $params['cpf'],
                'name' => $params['name'],
                'obs' => $params['obs'],
                'quantity_before' => $stock->stock_quantity,
                'quantity_updated' => $stock->stock_quantity - intval($params['quantity_withdrawn']),
                'quantity_withdrawn' => $params['quantity_withdrawn'],
                'sign' => $params['sign'],
                'add_id' => $params['add_id'],
            ];

            $resp = $this->repository->withDrawn($withDrawn);
            $destination = $this->repository->getTransport($params['destination_id']);
            $resp->product = "Cód.: " . $stock->id . " - " . $stock->product_name;
            $resp->stock = $stock;
            $resp->destination = $destination->transport;
            $resp->now = Carbon::now()->format('d/m/Y H:i');

            // Salvando relatorio
            $report = $this->reportsRepository->createReport();
            $this->reportsRepository->createReportItems($report->id, $resp->id);
            DB::commit();

            return $resp;
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function withDrawnMulti($params)
    {
        DB::beginTransaction();
        try {
            $arr = [];
            $destination = $this->repository->getTransport($params['destination_id']);

            // Salvando relatorio
            $report = $this->reportsRepository->createReport();

            foreach ($params['add_id'] as $product) {
                //registrando a baixa
                $this->addUsedQuantity($product['stock_id'], $product['id'], $product['quantity_selected']);
                $stock = $this->repository->show($product['stock_id']);

                if (empty($stock)) {
                    throw new Exception('Produto não encontrado');
                }

                $data = [
                    'stock_quantity' => $stock->stock_quantity - intval($product['quantity_selected']),
                    'last_destination' => $params['destination_id'],
                    'last_withdrawn' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $this->repository->updateStock($data, $product['stock_id']);

                $withDrawn = [
                    'stock_id' => $stock->id,
                    'user_id' => Auth::id(),
                    'destination_id' => $params['destination_id'],
                    'cpf' => $params['cpf'],
                    'name' => $params['name'],
                    'obs' => $params['obs'],
                    'quantity_before' => $stock->stock_quantity,
                    'quantity_updated' => $stock->stock_quantity - intval($product['quantity_selected']),
                    'quantity_withdrawn' => $product['quantity_selected'],
                    'sign' => $params['sign'],
                    'add_id' => $product['id'],
                ];

                $withdrawn = $this->repository->withDrawn($withDrawn);
                $withdrawn->product = "Cód.: " . $stock->id . " - " . $stock->product_name;
                $withdrawn->batch = $product['batch'];
                $withdrawn->stock = $stock;

                $arr[] = $withdrawn;

                // Salvando itens do relatorios
                $this->reportsRepository->createReportItems($report->id, $withdrawn->id);
            }

            DB::commit();
            return [
                'resp' => $arr,
                'name' => $params['name'],
                'cpf' => $params['cpf'],
                'obs' => $params['obs'],
                'sign' => $params['sign'],
                'destination' => $destination->transport,
                'now' => Carbon::now()->format('d/m/Y H:i')
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
    public function getAdds($id)
    {
        $data = $this->repository->getAdd($id);
        $res = [];
        foreach ($data as $item) {
            $arr['id'] = $item->id;
            $arr['label'] = $item->batch . ' -  Estoque: ' . ($item->quantity_add - $item->quantity_used);
            $arr['stock'] = $item->quantity_add - $item->quantity_used;
            $res[] = $arr;
        }
        return $res;
    }
    public function getAddComponents($id)
    {
        $data = $this->repository->getAdd($id);
        return $data;
    }

    public function addStock($params, $id)
    {
        DB::beginTransaction();
        try {
            $stock = $this->repository->show($id);

            if (empty($stock)) {
                throw new Exception('Produto não encontrado');
            }

            $data = [
                'stock_quantity' => $stock->stock_quantity + intval($params['quantity_add'])
            ];

            if (empty($stock->expiration_date) || $params['expiration_date'] < $stock->expiration_date) {
                $data['expiration_date'] = date('Y-m-d', strtotime($params['expiration_date']));
            }

            $this->repository->updateStock($data, $id);

            $add = [
                'user_id' => Auth::id(),
                'stock_id' => $stock->id,
                'quantity_before' => $stock->stock_quantity,
                'quantity_updated' => $stock->stock_quantity + intval($params['quantity_add']),
                'quantity_add' => $params['quantity_add'],
                'nf' => $params['nf'],
                'batch' => $params['batch'],
                'expiration_date' => date('Y-m-d', strtotime($params['expiration_date'])),
                'quantity_used' => 0,
            ];

            $resp = $this->repository->addStock($add);
            DB::commit();
            return $resp;
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function history($id)
    {
        $total =  $this->repository->history($id);

        return $total;
    }
    public function getTop50()
    {
        $total =  $this->repository->top50();

        return $total;
    }

    private function addUsedQuantity($stockId, $stockAddId, $quantity)
    {
        $stock = $this->repository->showAdd($stockId, $stockAddId);
        if ($quantity + $stock->quantity_used <= $stock->quantity_add) {
            $this->repository->addUpdate($stockAddId, ['quantity_used' => $stock->quantity_used + $quantity]);
        } else {
            throw new Exception('Valor não permitido');
        }
    }
    public function getReports($params)
    {
        $total = $this->repository->getReports($params);

        $data = [];
        foreach ($total->items() as $item) {
            $name = "";
            $destination = "";
            $responsible = "";
            foreach ($item['reports'] as $countReport =>  $report) {
                $responsible = $report['withdrawns'][0]['name'] . ' - ' . $report['withdrawns'][0]['cpf'];

                foreach ($report['withdrawns'] as $withdrawns) {
                    $name .= $withdrawns['stock'][0]["product_name"] . ": " . $withdrawns["quantity_withdrawn"];
                    if ($countReport < (count($item['reports']) - 1)) {
                        $name .= " - ";
                    }

                    if ($countReport == (count($item['reports']) - 1)) {
                        $transport = Transport::where('id', $withdrawns['destination_id'])->select('transport')->first()->transport;
                        $destination .= $transport;
                    }
                }
            }
            $data[] = [
                'id' => $item['id'],
                'created_at_formatted' => $item['created_at_formatted'],
                'itens' => $name,
                'responsible' => $responsible,
                'destination' => $destination,
            ];
        }

        // Supondo que haja um método setItems para atualizar os itens
        if (method_exists($total, 'setItems')) {
            $total->setItems($data);
        } else {
            // Caso contrário, você pode precisar criar um novo objeto com os dados atualizados
            $total = new Paginator($data, $total->total(), $total->perPage());
        }

        return $total;
    }

    public function pdfReportById($id)
    {
        $total = $this->repository->getReportById($id);
        $name = "";
        $cpf = "";
        $obs = "";
        $sign = "";
        $destination = "";
        $resp = [];
        // dd($total);
        foreach ($total['reports'] as $item) {

            if (!empty($item['withdrawns'][0]['cpf'])) {
                $cpf = $item['withdrawns'][0]['cpf'];
            }

            if (!empty($item['withdrawns'][0]['name'])) {
                $name = $item['withdrawns'][0]['name'];
            }

            if (!empty($item['withdrawns'][0]['obs'])) {
                $obs = $item['withdrawns'][0]['obs'];
            }

            if (!empty($item['withdrawns'][0]['sign'])) {
                $sign = $item['withdrawns'][0]['sign'];
            }

            if (!empty($item['withdrawns'][0]['destination_id'])) {
                $transport = Transport::where('id', $item['withdrawns'][0]['destination_id'])->select('transport')->first()->transport;
                $destination = $transport;
            }

            // $now = $item['withdrawns'][0]['created_at'];
            $add = $this->repository->showAdd($item['withdrawns'][0]['stock_id'], $item['withdrawns'][0]['add_id']);
            $arr = [];
            $arr = $item['withdrawns'][0];
            $arr['batch'] = $add['batch'];
            $arr['stock'] = (object)$item['withdrawns'][0]['stock'][0];
            $arr['product'] = "Cód.: " . $item['withdrawns'][0]['stock_id'] . " - " . $item['withdrawns'][0]['stock'][0]['product_name'];
            $resp[] = (object)$arr;
        }
        return [
            'resp' => $resp,
            'name' => $name,
            'cpf' => $cpf,
            'obs' => $obs,
            'sign' => $sign,
            'destination' => $destination,
            'now' => $total['created_at_formatted']
        ];
    }
}
