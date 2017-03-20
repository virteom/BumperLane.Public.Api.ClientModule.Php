<?php

namespace BumperLane\Api\ClientModule\Send;
class Email {
    const RESPONSE_KEY_VALUE = 'value';
    const RESPONSE_VALUE_FAILED = 'Failed';
    const API_PATH_FUNCTION_EMAIL = 'ApplicationsApplicationDetail/BumperLane.Hosted.Api.V2.Application.API.Applications.Email';
    const API_KEY_SUBJECT = 'Subject';
    const API_KEY_TO = 'To';
    const API_KEY_FROM = 'From';
    const API_KEY_HTML_BODY = 'Body';

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
        $responses = array();
        foreach($this->To as $recipient){
            $request = $this->api->BuildRequest(Email::API_PATH_FUNCTION_EMAIL);
            $data = array(
                Email::API_KEY_SUBJECT     => $this->Subject,
                Email::API_KEY_TO          => $recipient,
                Email::API_KEY_FROM        => $this->From,
                Email::API_KEY_HTML_BODY   => $this->HtmlBody
            );
           
            $json = json_encode($data);
            $responseObject = $request->Post($json);
            if($responseObject == null){
                $responses[] = Email::RESPONSE_VALUE_FAILED;
            }

            $responseJson = $responseObject->getBody();
            if($responseJson == null){
                $responses[] = Email::RESPONSE_VALUE_FAILED;
            }
            
            $response = json_decode($responseJson, true);
            if($response == null || !array_key_exists(Email::RESPONSE_KEY_VALUE, $response)){
                $responses[] = Email::RESPONSE_VALUE_FAILED;
            }
            else {
                $responses[] = $response[Email::RESPONSE_KEY_VALUE];
            }
        }

        return $responses;
    }
}