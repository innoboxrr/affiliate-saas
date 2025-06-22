<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliateConversionPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir todo a admins, excepto habilidades explícitamente excluidas.
     */
    public function before($user, $ability)
    {
        $exceptAbilities = config('affiliate.permissions.affiliate-conversion-except-abilities', []);

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
        return $this->callUserMethod($user, 'indexAffiliateConversion');
    }

    public function viewAny(User $user)
    {
        return $this->callUserMethod($user, 'viewAnyAffiliateConversion');
    }

    public function view(User $user, AffiliateConversion $affiliateConversion)
    {
        return $this->callUserMethod($user, 'viewAffiliateConversion', $affiliateConversion);
    }

    public function create(User $user)
    {
        return $this->callUserMethod($user, 'createAffiliateConversion');
    }

    public function update(User $user, AffiliateConversion $affiliateConversion)
    {
        return $this->callUserMethod($user, 'updateAffiliateConversion', $affiliateConversion);
    }

    public function delete(User $user, AffiliateConversion $affiliateConversion)
    {
        return $this->callUserMethod($user, 'deleteAffiliateConversion', $affiliateConversion);
    }

    public function restore(User $user, AffiliateConversion $affiliateConversion)
    {
        return $this->callUserMethod($user, 'restoreAffiliateConversion', $affiliateConversion);
    }

    public function forceDelete(User $user, AffiliateConversion $affiliateConversion)
    {
        return $this->callUserMethod($user, 'forceDeleteAffiliateConversion', $affiliateConversion);
    }

    public function export(User $user)
    {
        return $this->callUserMethod($user, 'exportAffiliateConversion');
    }
}
