<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliatePayoutPolicy
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

    public function view(User $user, AffiliatePayout $affiliatePayout)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, AffiliatePayout $affiliatePayout)
    {
        return false;
    }

    public function delete(User $user, AffiliatePayout $affiliatePayout)
    {
        return false;
    }

    public function restore(User $user, AffiliatePayout $affiliatePayout)
    {
        return false;
    }

    public function forceDelete(User $user, AffiliatePayout $affiliatePayout)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

}
