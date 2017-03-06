<?php
namespace BumperLane\Api\ClientModule\Send;
class Email {
    const RESPONSE_VALUE_KEY = 'value';

    public $HtmlBody = null;
    public $TextBody = null;
    public $Subject = null;
    public $From = null;
    public $To = array();
    public $Priority = null;
    private $api = null;
    
    public function __construct($clientId = MODERN_API_CLIENT_ID, $clientSecret = MODERN_API_CLIENT_SECRET, $baseUrl = MODERN_API_SITE_URL){
        $this->api = \BumperLane\Api\Client\ApiClient::Create(\BumperLane\Api\ClientModule\CoreV2::class, $clientId, $clientSecret, $baseUrl);
    }

    public function Send(){
        foreach($this->To as $recipient){
            $this->api->BuildRequest("ApplicationsApplicationDetail/API.Core.V2.API.Applications.Email");
            $data = array(
                "Subject" => $this->Subject,
                "To" => $recipient,
                "From" => $this->From,
                "Body" => $this->HtmlBody
            );
           
            $json = json_encode($data);
            $responseJson = $request->Post($json);
            if($responseJson == null){
                return "Failed";
            }

            $response = json_decode($responseJson, true);
            if($response == null || !array_key_exists(RESPONSE_VALUE_KEY, $response)){
                return "Failed";
            }

            return $response[RESPONSE_VALUE_KEY];
        }
    }
}