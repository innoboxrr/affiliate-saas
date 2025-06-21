<?php

namespace Innoboxrr\AffiliateSaas\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\AffiliateSaas\Tests\TestCase;

class AffiliateAssetEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_affiliate_asset_policies_endpoint()
    {

        $affiliateAsset = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $affiliateAsset->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-asset/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_asset_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-asset/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_affiliate_asset_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-asset/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_affiliate_asset_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-asset/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_affiliate_asset_show_auth_endpoint()
    {

        $affiliateAsset = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_asset_id' => $affiliateAsset->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-asset/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_asset_show_guest_endpoint()
    {

        $affiliateAsset = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_asset_id' => $affiliateAsset->id
        ];

        $this->json('GET', '/api/innoboxrr/affiliatesaas/affiliate-asset/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_affiliate_asset_create_endpoint()
    {

        $user = \Innoboxrr\AffiliateSaas\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-asset/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_affiliate_asset_update_endpoint()
    {

        $affiliateAsset = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\AffiliateSaas\Models\AffiliateAsset::factory()->make()->getAttributes(),
            'affiliate_asset_id' => $affiliateAsset->id
        ];

        $this->json('PUT', '/api/innoboxrr/affiliatesaas/affiliate-asset/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_asset_delete_endpoint()
    {

        $affiliateAsset = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_asset_id' => $affiliateAsset->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-asset/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_asset_restore_endpoint()
    {

        $affiliateAsset = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_asset_id' => $affiliateAsset->id
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-asset/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_affiliate_asset_force_delete_endpoint()
    {

        $affiliateAsset = \Innoboxrr\AffiliateSaas\Models\AffiliateAsset::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'affiliate_asset_id' => $affiliateAsset->id
        ];

        $this->json('DELETE', '/api/innoboxrr/affiliatesaas/affiliate-asset/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_affiliate_asset_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/affiliatesaas/affiliate-asset/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
