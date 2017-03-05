<?php
namespace BumperLane\Api\ClientModule;
class CoreV2 extends \BumperLane\Api\Client\Core\ClientModuleBase {
    public function __construct(){
        $this->Api = "core/v2";
    }
}