<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliatePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {

        $exceptAbilities = [];

        if($user->isAdmin() && !in_array($ability, $exceptAbilities)){
        
            return true;
            
        }

    }

    public function index(User $user)
    {
        return false;
    }

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Affiliate $affiliate)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Affiliate $affiliate)
    {
        return false;
    }

    public function delete(User $user, Affiliate $affiliate)
    {
        return false;
    }

    public function restore(User $user, Affiliate $affiliate)
    {
        return false;
    }

    public function forceDelete(User $user, Affiliate $affiliate)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}
