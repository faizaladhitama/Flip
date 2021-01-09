<?php

namespace App\Helper;
use GuzzleHttp\Psr7\Request;

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
		if($this->method == 'GET'){
			$response = new Request($this->method, $this->url, $this->header, $this->requestParameter);
		}else{
			$response = new Request($this->method, $this->url, $this->header, $this->body);
		}

		return $response;
	}
}
