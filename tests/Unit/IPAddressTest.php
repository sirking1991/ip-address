<?php

namespace Tests\Unit;

use App\Classes\AuditLogService;
use App\Classes\IPAddressService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class IPAddressTest extends TestCase
{
    // use RefreshDatabase;
    
    public function test_should_create_new_using_static_call()
    {
        $this->assertNotEmpty( IPAddressService::upcreate('127.0.0.1', 'localhost') );
        $this->assertNotEmpty( IPAddressService::upcreate('216.58.200.78', 'google.com') );
    }

    public function test_should_create_new_using_http_request()
    {
        $response = $this->post('/login', ['email' => 'testuser@email.com','password' => 'password',]);
        $this->assertAuthenticated();

        $response = $this->post('/ipaddress-save', ['ip'=>'127.0.0.1', 'label'=>'localhost']);
        $response->assertStatus(200);
    }

    public function test_should_update_label()
    {
        $temp = IPAddressService::upcreate('127.0.0.1', 'localhost');
        $this->assertEquals($temp->label, 'localhost');
        
        $temp = IPAddressService::upcreate('127.0.0.1', 'loopback');        
        $this->assertEquals($temp->ip, '127.0.0.1');
        $this->assertEquals($temp->label, 'loopback');
    }
    
    public function test_should_return_list_using_static_call()
    {
        $this->assertNotEmpty( IPAddressService::upcreate('127.0.0.1', 'localhost') );
        $this->assertNotEmpty( IPAddressService::upcreate('216.58.200.78', 'google.com') );        
        $this->assertNotEmpty( IPAddressService::list() );
    }

    public function test_should_return_list_using_http_request()
    {
        $this->post('/login', ['email' => 'testuser@email.com','password' => 'password',]);

        $this->post('/ipaddress-save', ['ip'=>'127.0.0.1', 'label'=>'localhost']);
        $this->post('/ipaddress-save', ['ip'=>'74.6.231.20', 'label'=>'yahoo.com']);
        $this->post('/ipaddress-save', ['ip'=>'216.58.200.78', 'label'=>'google.com']);

        $response = $this->get('/ipaddress-list');
        $response->assertStatus(200);
    }    

    public function test_should_return_audit_logs_using_static_call()
    {
        $this->assertNotEmpty( IPAddressService::upcreate('127.0.0.1', 'localhost') );
        $this->assertNotEmpty( IPAddressService::upcreate('127.0.0.1', 'loopback') );
        
        $response = AuditLogService::list('127.0.0.1');
        $this->assertNotEmpty( $response );
        $this->assertNotEmpty( $response[0]);
        $this->assertEquals(
            ['ip'=>'127.0.0.1','user_id'=>"1",'remarks'=>'created'],
            ['ip'=>$response[0]->ip,'user_id'=>$response[0]->user_id,'remarks'=>$response[0]->remarks],
        );
        $this->assertEquals(
            ['ip'=>'127.0.0.1','user_id'=>"1",'remarks'=>'updated'],
            ['ip'=>$response[1]->ip,'user_id'=>$response[1]->user_id,'remarks'=>$response[1]->remarks],
        );

        $this->assertEmpty( AuditLogService::list('192.168.0.1') );
    }

    public function test_should_return_audit_logs_using_http_request()
    {
        $this->post('/login', ['email' => 'testuser@email.com','password' => 'password',]);

        $this->post('/ipaddress-save', ['ip'=>'127.0.0.1', 'label'=>'loopback']);
        $this->post('/ipaddress-save', ['ip'=>'127.0.0.1', 'label'=>'localhost']);

        $response = $this->get('/ipaddress-audit-logs/127.0.0.1');        
        $response->assertStatus(200);
        $response->assertJson(
            [
                ['ip'=>'127.0.0.1','user_id'=>"1",'remarks'=>'created'],
                ['ip'=>'127.0.0.1','user_id'=>"1",'remarks'=>'updated']
            ]
        );

        $response = $this->get('/ipaddress-audit-logs/192.168.0.1');
        $response->assertJson([]);

        
    }


}
