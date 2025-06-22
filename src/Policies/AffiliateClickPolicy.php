<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliateClickPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir todo a admins, excepto habilidades explícitamente excluidas.
     */
    public function before($user, $ability)
    {
        $exceptAbilities = config('affiliate.permissions.affiliate-click-except-abilities', []);

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
        return $this->callUserMethod($user, 'indexAffiliateClick');
    }

    public function viewAny(User $user)
    {
        return $this->callUserMethod($user, 'viewAnyAffiliateClick');
    }

    public function view(User $user, AffiliateClick $affiliateClick)
    {
        return $this->callUserMethod($user, 'viewAffiliateClick', $affiliateClick);
    }

    public function create(User $user)
    {
        return $this->callUserMethod($user, 'createAffiliateClick');
    }

    public function update(User $user, AffiliateClick $affiliateClick)
    {
        return $this->callUserMethod($user, 'updateAffiliateClick', $affiliateClick);
    }

    public function delete(User $user, AffiliateClick $affiliateClick)
    {
        return $this->callUserMethod($user, 'deleteAffiliateClick', $affiliateClick);
    }

    public function restore(User $user, AffiliateClick $affiliateClick)
    {
        return $this->callUserMethod($user, 'restoreAffiliateClick', $affiliateClick);
    }

    public function forceDelete(User $user, AffiliateClick $affiliateClick)
    {
        return $this->callUserMethod($user, 'forceDeleteAffiliateClick', $affiliateClick);
    }

    public function export(User $user)
    {
        return $this->callUserMethod($user, 'exportAffiliateClick');
    }
}
