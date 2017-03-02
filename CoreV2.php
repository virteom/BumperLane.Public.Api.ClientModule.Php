<?php

namespace Virteom\ApiClient\Php;
include_once(__DIR__ . '/../includes.php');

class CoreV2 extends ClientModuleBase {
    public function __construct(){
        $this->Api = "core/v2";
    }
}