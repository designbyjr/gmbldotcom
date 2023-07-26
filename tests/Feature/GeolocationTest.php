<?php

namespace Tests\Feature;

use App\Services\GeolocationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GeolocationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGeolocationService()
    {
        $class = new GeolocationService(53.3340285, -6.2535495);
        $affiliates = $class->filterAffiliatesByDistFile(storage_path('app/public/Gambling.com - affiliates.txt'),250);
        $this->assertIsArray($affiliates);
        $this->assertArrayHasKey('distance',$affiliates[0]);
        $this->assertArrayHasKey('name',$affiliates[0]);
        $this->assertArrayHasKey('affiliate_id',$affiliates[0]);
    }
}
