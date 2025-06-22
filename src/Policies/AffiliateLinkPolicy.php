<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliateLinkPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir todo a admins, excepto habilidades explícitamente excluidas.
     */
    public function before($user, $ability)
    {
        $exceptAbilities = config('affiliate.permissions.affiliate-link-except-abilities', []);

        if (method_exists($user, 'isAdmin') && $user->isAdmin() && !in_array($ability, $exceptAbilities)) {
            return true;
        }
    }

    /**
     * Llamador central a métodos definidos en el usuario.
     */
    protected function callUserMethod(User $user, string $method, ...$arguments): bool
    {
        return method_exists($user, $method) ? $user->{$method}(...$arguments) : false;
    }

    public function index(User $user)
    {
        return $this->callUserMethod($user, 'indexAffiliateLink');
    }

    public function viewAny(User $user)
    {
        return $this->callUserMethod($user, 'viewAnyAffiliateLink');
    }

    public function view(User $user, AffiliateLink $affiliateLink)
    {
        return $this->callUserMethod($user, 'viewAffiliateLink', $affiliateLink);
    }

    public function create(User $user)
    {
        return $this->callUserMethod($user, 'createAffiliateLink');
    }

    public function update(User $user, AffiliateLink $affiliateLink)
    {
        return $this->callUserMethod($user, 'updateAffiliateLink', $affiliateLink);
    }

    public function delete(User $user, AffiliateLink $affiliateLink)
    {
        return $this->callUserMethod($user, 'deleteAffiliateLink', $affiliateLink);
    }

    public function restore(User $user, AffiliateLink $affiliateLink)
    {
        return $this->callUserMethod($user, 'restoreAffiliateLink', $affiliateLink);
    }

    public function forceDelete(User $user, AffiliateLink $affiliateLink)
    {
        return $this->callUserMethod($user, 'forceDeleteAffiliateLink', $affiliateLink);
    }

    public function export(User $user)
    {
        return $this->callUserMethod($user, 'exportAffiliateLink');
    }
}
