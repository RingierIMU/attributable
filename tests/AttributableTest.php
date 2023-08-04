<?php

namespace Tests;

use Fixtures\Models\Listing;
use Fixtures\Models\ListingWithSoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class AttributableTest extends TestCase
{
    use RefreshDatabase;

    public function testHasAttr(): void
    {
        $model = Listing::create([
            'title' => 'testing',
        ]);

        $this->assertIsArray($model->attr);

        $model->attr['currency'] = 'USD';
        $model->save();

        /** @var object $raw */
        $raw = DB::table('rimu_attributes')
            ->where('attributable_id', $model->id)
            ->first();

        $this->assertEquals(
            ['currency' => 'USD'],
            json_decode($raw->attributes, associative: true)
        );
    }

    public function testSoftDeletesAttr(): void
    {
        $model = ListingWithSoftDeletes::create([
            'title' => 'testing',
        ]);

        $model->delete();

        /** @var object $raw */
        $raw = DB::table('rimu_attributes')
            ->where('attributable_id', $model->id)
            ->first();

        $this->assertNotNull($raw->deleted_at);

        $model->restore();

        /** @var object $raw */
        $raw = DB::table('rimu_attributes')
            ->where('attributable_id', $model->id)
            ->first();

        $this->assertNull($raw->deleted_at);
    }
}
