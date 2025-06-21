<?php

namespace Innoboxrr\AffiliateSaas\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\AffiliateSaas\Tests\TestCase;

class AffiliateLinkEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_affiliate_link_policies_endpoint()
    {

        $affiliateLink = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $affiliateLink->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-link/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_link_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-link/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_affiliate_link_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-link/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_link_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-link/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_affiliate_link_show_auth_endpoint()
    {

        $affiliateLink = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_link_id' => $affiliateLink->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-link/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_link_show_guest_endpoint()
    {

        $affiliateLink = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_link_id' => $affiliateLink->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-link/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_affiliate_link_create_endpoint()
    {

        $user = \Innoboxrr\AffiliateSaas\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-link/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_affiliate_link_update_endpoint()
    {

        $affiliateLink = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\AffiliateSaas\Models\AffiliateLink::factory()->make()->getAttributes(),
            'affiliate_link_id' => $affiliateLink->id
        ];

        $this->json('PUT', '/api/innoboxrr/affiliatesaas/affiliate-link/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_link_delete_endpoint()
    {

        $affiliateLink = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_link_id' => $affiliateLink->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-link/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_link_restore_endpoint()
    {

        $affiliateLink = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_link_id' => $affiliateLink->id
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-link/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_link_force_delete_endpoint()
    {

        $affiliateLink = \Innoboxrr\AffiliateSaas\Models\AffiliateLink::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_link_id' => $affiliateLink->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-link/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_affiliate_link_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-link/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
