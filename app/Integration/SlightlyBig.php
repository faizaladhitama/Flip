<?php

namespace App\Integration;
use App\Helper\CUrl;

class SlightlyBig
{
	protected $secretKey = 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41';
	protected $baseUrl = 'https://nextar.flip.id';
	protected $authorization;

	public function __construct()
	{
		$this->authorization = base64_encode($this->secretKey . ":");
	}

	private function getHeader(){
		return [
			'Authorization' => 'Basic '. $this->authorization,
			'Content-Type' => 'application/x-www-form-urlencoded'
		];
	}

	public function sendDisbursement($data){
		$url = $this->baseUrl . "/disburse";
		$curl = new CUrl();
		$curl->setMethod('POST');
		$curl->setUrl($url);
		$curl->setHeader($this->getHeader());
		$curl->setBody($data);

		$response = $curl->sendRequest();

		return json_decode($response->getBody()->getContents());
	}

	public function getDisbursement($transaction_id){
		$url = $this->baseUrl . "/disburse/$transaction_id";
		$curl = new CUrl();
		$curl->setMethod('GET');
		$curl->setUrl($url);
		$curl->setHeader($this->getHeader());
		$curl->setParameterRequest([]);

		$response = $curl->sendRequest();
		return json_decode($response->getBody()->getContents());
	}
}
