<?php

namespace App\Http\Services;

use App\Http\Repositories\NotificationRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class NotificationService
{

    private $repository;
    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function updateAll()
    {
        return $this->repository->updateAll();
    }

}
