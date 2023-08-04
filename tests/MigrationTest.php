<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class MigrationTest extends TestCase
{
    public function testTableNameFromConfig(): void
    {
        $this->artisan('migrate');
        $this->assertTrue(Schema::hasTable('rimu_attributes'));
    }
}
