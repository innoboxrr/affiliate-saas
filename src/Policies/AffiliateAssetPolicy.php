<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliateAssetPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir todo a admins, excepto habilidades explícitamente excluidas.
     */
    public function before($user, $ability)
    {
        $exceptAbilities = config('affiliate.permissions.affiliate-asset-except-abilities', []);

        if (method_exists($user, 'isAdmin') && $user->isAdmin() && !in_array($ability, $exceptAbilities)) {
            return true;
        }
    }

    /**
     * Llamador central a métodos definidos en el usuario (usando traits).
     */
    protected function callUserMethod(User $user, string $method, ...$arguments): bool
    {
        return method_exists($user, $method) ? $user->{$method}(...$arguments) : false;
    }

    public function index(User $user)
    {
        return $this->callUserMethod($user, 'indexAffiliateAsset');
    }

    public function viewAny(User $user)
    {
        return $this->callUserMethod($user, 'viewAnyAffiliateAsset');
    }

    public function view(User $user, AffiliateAsset $affiliateAsset)
    {
        return $this->callUserMethod($user, 'viewAffiliateAsset', $affiliateAsset);
    }

    public function create(User $user)
    {
        return $this->callUserMethod($user, 'createAffiliateAsset');
    }

    public function update(User $user, AffiliateAsset $affiliateAsset)
    {
        return $this->callUserMethod($user, 'updateAffiliateAsset', $affiliateAsset);
    }

    public function delete(User $user, AffiliateAsset $affiliateAsset)
    {
        return $this->callUserMethod($user, 'deleteAffiliateAsset', $affiliateAsset);
    }

    public function restore(User $user, AffiliateAsset $affiliateAsset)
    {
        return $this->callUserMethod($user, 'restoreAffiliateAsset', $affiliateAsset);
    }

    public function forceDelete(User $user, AffiliateAsset $affiliateAsset)
    {
        return $this->callUserMethod($user, 'forceDeleteAffiliateAsset', $affiliateAsset);
    }

    public function export(User $user)
    {
        return $this->callUserMethod($user, 'exportAffiliateAsset');
    }
}
