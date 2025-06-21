<?php

namespace Innoboxrr\AffiliateSaas\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\AffiliateSaas\Tests\TestCase;

class AffiliateProgramEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_affiliate_program_policies_endpoint()
    {

        $affiliateProgram = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $affiliateProgram->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-program/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_program_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-program/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_affiliate_program_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-program/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_program_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-program/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_affiliate_program_show_auth_endpoint()
    {

        $affiliateProgram = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_program_id' => $affiliateProgram->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-program/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_program_show_guest_endpoint()
    {

        $affiliateProgram = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_program_id' => $affiliateProgram->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-program/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_affiliate_program_create_endpoint()
    {

        $user = \Innoboxrr\AffiliateSaas\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-program/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_affiliate_program_update_endpoint()
    {

        $affiliateProgram = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\AffiliateSaas\Models\AffiliateProgram::factory()->make()->getAttributes(),
            'affiliate_program_id' => $affiliateProgram->id
        ];

        $this->json('PUT', '/api/innoboxrr/affiliatesaas/affiliate-program/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_program_delete_endpoint()
    {

        $affiliateProgram = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_program_id' => $affiliateProgram->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-program/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_program_restore_endpoint()
    {

        $affiliateProgram = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_program_id' => $affiliateProgram->id
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-program/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_program_force_delete_endpoint()
    {

        $affiliateProgram = \Innoboxrr\AffiliateSaas\Models\AffiliateProgram::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_program_id' => $affiliateProgram->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-program/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_affiliate_program_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-program/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
