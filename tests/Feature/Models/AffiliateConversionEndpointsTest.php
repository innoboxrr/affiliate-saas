<?php

namespace Innoboxrr\AffiliateSaas\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\AffiliateSaas\Tests\TestCase;

class AffiliateConversionEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_affiliate_conversion_policies_endpoint()
    {

        $affiliateConversion = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $affiliateConversion->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-conversion/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_conversion_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-conversion/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_affiliate_conversion_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-conversion/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_conversion_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-conversion/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_affiliate_conversion_show_auth_endpoint()
    {

        $affiliateConversion = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_conversion_id' => $affiliateConversion->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-conversion/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_conversion_show_guest_endpoint()
    {

        $affiliateConversion = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_conversion_id' => $affiliateConversion->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-conversion/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_affiliate_conversion_create_endpoint()
    {

        $user = \Innoboxrr\AffiliateSaas\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-conversion/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_affiliate_conversion_update_endpoint()
    {

        $affiliateConversion = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\AffiliateSaas\Models\AffiliateConversion::factory()->make()->getAttributes(),
            'affiliate_conversion_id' => $affiliateConversion->id
        ];

        $this->json('PUT', '/api/innoboxrr/affiliatesaas/affiliate-conversion/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_conversion_delete_endpoint()
    {

        $affiliateConversion = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_conversion_id' => $affiliateConversion->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-conversion/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_conversion_restore_endpoint()
    {

        $affiliateConversion = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_conversion_id' => $affiliateConversion->id
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-conversion/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_conversion_force_delete_endpoint()
    {

        $affiliateConversion = \Innoboxrr\AffiliateSaas\Models\AffiliateConversion::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_conversion_id' => $affiliateConversion->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-conversion/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_affiliate_conversion_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-conversion/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
