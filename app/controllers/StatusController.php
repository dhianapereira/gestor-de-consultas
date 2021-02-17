<?php

namespace app\controllers;

use src\services\StatusService;

class StatusController
{
    private $status_service;

    public function __construct()
    {
        $this->status_service =  new StatusService();
    }

    public function allStatus()
    {

        $result = $this->status_service->allStatus();

        return $result;
    }
}
