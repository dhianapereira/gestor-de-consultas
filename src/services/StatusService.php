<?php

namespace src\services;

use src\data\Facade;

class StatusService
{

    private $facade;

    public function __construct()
    {
        $this->facade =  new Facade();
    }

    public function allStatus()
    {

        $result = $this->facade->allStatus();

        return $result;
    }
}
