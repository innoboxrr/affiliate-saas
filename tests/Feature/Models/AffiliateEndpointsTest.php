<?php

namespace Innoboxrr\AffiliateSaas\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\AffiliateSaas\Tests\TestCase;

class AffiliateEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_affiliate_policies_endpoint()
    {

        $affiliate = \Innoboxrr\AffiliateSaas\Models\Affiliate::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $affiliate->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_affiliate_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_affiliate_show_auth_endpoint()
    {

        $affiliate = \Innoboxrr\AffiliateSaas\Models\Affiliate::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_id' => $affiliate->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_show_guest_endpoint()
    {

        $affiliate = \Innoboxrr\AffiliateSaas\Models\Affiliate::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_id' => $affiliate->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_affiliate_create_endpoint()
    {

        $user = \Innoboxrr\AffiliateSaas\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\AffiliateSaas\Models\Affiliate::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_affiliate_update_endpoint()
    {

        $affiliate = \Innoboxrr\AffiliateSaas\Models\Affiliate::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\AffiliateSaas\Models\Affiliate::factory()->make()->getAttributes(),
            'affiliate_id' => $affiliate->id
        ];

        $this->json('PUT', '/api/innoboxrr/affiliatesaas/affiliate/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_delete_endpoint()
    {

        $affiliate = \Innoboxrr\AffiliateSaas\Models\Affiliate::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_id' => $affiliate->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_restore_endpoint()
    {

        $affiliate = \Innoboxrr\AffiliateSaas\Models\Affiliate::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_id' => $affiliate->id
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_force_delete_endpoint()
    {

        $affiliate = \Innoboxrr\AffiliateSaas\Models\Affiliate::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_id' => $affiliate->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_affiliate_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
