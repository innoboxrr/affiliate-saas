<?php

namespace Innoboxrr\AffiliateSaas\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\AffiliateSaas\Tests\TestCase;

class AffiliatePayoutEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_affiliate_payout_policies_endpoint()
    {

        $affiliatePayout = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $affiliatePayout->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-payout/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_payout_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-payout/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_affiliate_payout_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-payout/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_payout_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-payout/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_affiliate_payout_show_auth_endpoint()
    {

        $affiliatePayout = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_payout_id' => $affiliatePayout->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-payout/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_payout_show_guest_endpoint()
    {

        $affiliatePayout = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_payout_id' => $affiliatePayout->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-payout/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_affiliate_payout_create_endpoint()
    {

        $user = \Innoboxrr\AffiliateSaas\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-payout/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_affiliate_payout_update_endpoint()
    {

        $affiliatePayout = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\AffiliateSaas\Models\AffiliatePayout::factory()->make()->getAttributes(),
            'affiliate_payout_id' => $affiliatePayout->id
        ];

        $this->json('PUT', '/api/innoboxrr/affiliatesaas/affiliate-payout/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_payout_delete_endpoint()
    {

        $affiliatePayout = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_payout_id' => $affiliatePayout->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-payout/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_payout_restore_endpoint()
    {

        $affiliatePayout = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_payout_id' => $affiliatePayout->id
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-payout/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_payout_force_delete_endpoint()
    {

        $affiliatePayout = \Innoboxrr\AffiliateSaas\Models\AffiliatePayout::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_payout_id' => $affiliatePayout->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-payout/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_affiliate_payout_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-payout/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
