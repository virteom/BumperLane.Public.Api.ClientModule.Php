<?php

namespace BumperLane\Api\ClientModule;
include_once(__DIR__ . '/../includes.php');

class CoreV2 extends \BumperLane\Api\Client\Core\ClientModuleBase {
    public function __construct(){
        $this->Api = "core/v2";
    }
}