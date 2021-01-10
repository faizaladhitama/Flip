<?php

namespace Tests\Unit;

use Tests\TestCase;

class DisbursementTest extends TestCase
{
    public function test_sendDisbursementPositive(){
    	$response = $this->post('/api/disbursement', [
    		'bank_code' => 'BNI',
    		'account_number' => '123456789',
    		'amount' => '10000',
    		'remark' => 'Test Flip'
    	]);

    	$response->assertStatus(201)
    			->assertJsonPath('data.bank_code', 'BNI')
    			->assertJsonPath('data.account_number', '123456789')
    			->assertJsonPath('data.amount', 10000)
    			->assertJsonPath('data.remark', 'Test Flip')
    			->assertJsonPath('data.status', 'PENDING');
    }

    public function test_sendDisbursementNegative(){
    	$response = $this->post('/api/disbursement', []);

    	$response->assertStatus(500);
    }
}
