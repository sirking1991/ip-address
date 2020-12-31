<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Classes\AuditLogService;

use Tests\TestCase;

class AuditLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_be_able_to_log()
    {
        $this->assertEmpty( AuditLogService::log('127.0.0.1', 1, 'localhost') );
        
    }
}
