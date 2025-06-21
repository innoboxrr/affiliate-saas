<?php

namespace Innoboxrr\AffiliateSaas\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\AffiliateSaas\Tests\TestCase;

class AffiliateClickEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_affiliate_click_policies_endpoint()
    {

        $affiliateClick = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $affiliateClick->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-click/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_click_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-click/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_affiliate_click_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-click/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_click_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-click/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_affiliate_click_show_auth_endpoint()
    {

        $affiliateClick = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_click_id' => $affiliateClick->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-click/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_click_show_guest_endpoint()
    {

        $affiliateClick = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_click_id' => $affiliateClick->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-click/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_affiliate_click_create_endpoint()
    {

        $user = \Innoboxrr\AffiliateSaas\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-click/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_affiliate_click_update_endpoint()
    {

        $affiliateClick = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\AffiliateSaas\Models\AffiliateClick::factory()->make()->getAttributes(),
            'affiliate_click_id' => $affiliateClick->id
        ];

        $this->json('PUT', '/api/innoboxrr/affiliatesaas/affiliate-click/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_click_delete_endpoint()
    {

        $affiliateClick = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_click_id' => $affiliateClick->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-click/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_click_restore_endpoint()
    {

        $affiliateClick = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_click_id' => $affiliateClick->id
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-click/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_click_force_delete_endpoint()
    {

        $affiliateClick = \Innoboxrr\AffiliateSaas\Models\AffiliateClick::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_click_id' => $affiliateClick->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-click/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_affiliate_click_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-click/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
