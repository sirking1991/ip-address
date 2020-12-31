<?php

namespace Tests\Unit;

use App\Classes\IPAddressService;
use App\Models\IPAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class IPAddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_create_new()
    {
        $this->assertNotEmpty( IPAddressService::upcreate('127.0.0.1', 'localhost') );
        $this->assertNotEmpty( IPAddressService::upcreate('216.58.200.78', 'google.com') );
    }

    public function test_should_update_label()
    {
        $temp = IPAddressService::upcreate('127.0.0.1', 'localhost');
        $this->assertEquals($temp->label, 'localhost');
        
        $temp = IPAddressService::upcreate('127.0.0.1', 'loopback');        
        $this->assertEquals($temp->ip, '127.0.0.1');
        $this->assertEquals($temp->label, 'loopback');
    }
    
    public function test_should_return_list()
    {
        $this->assertNotEmpty( IPAddressService::upcreate('127.0.0.1', 'localhost') );
        $this->assertNotEmpty( IPAddressService::upcreate('216.58.200.78', 'google.com') );        
        $this->assertNotEmpty( IPAddressService::list() );
    }
}
