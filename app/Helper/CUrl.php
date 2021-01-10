<?php

namespace App\Helper;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class CUrl
{
	protected $header;
	protected $body;
	protected $parameterRequest;
	protected $method;
	protected $url;

	public function setHeader($header){
		$this->header = $header;
	}

	public function setBody($body){
		$this->body = $body;
	}

	public function setParameterRequest($parameterRequest){
		$this->parameterRequest = $parameterRequest;
	}

	public function setMethod($method){
		$this->method = $method;
	}

	public function setUrl($url){
		$this->url = $url;
	}		

	public function sendRequest(){
		$client = new Client();
		$option = [
			'headers' => $this->header
		];

		if($this->method == 'GET'){
			$response = $client->request($this->method, $this->url, $option);
		}else{
			$option['form_params'] = $this->body; 
			$response = $client->request($this->method, $this->url, $option);
		}

		return $response;
	}
}
