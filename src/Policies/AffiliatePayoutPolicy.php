<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliatePayoutPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir todo a admins, excepto habilidades explícitamente excluidas.
     */
    public function before($user, $ability)
    {
        $exceptAbilities = config('affiliate.permissions.affiliate-payout-except-abilities', []);

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
        return $this->callUserMethod($user, 'indexAffiliatePayout');
    }

    public function viewAny(User $user)
    {
        return $this->callUserMethod($user, 'viewAnyAffiliatePayout');
    }

    public function view(User $user, AffiliatePayout $affiliatePayout)
    {
        return $this->callUserMethod($user, 'viewAffiliatePayout', $affiliatePayout);
    }

    public function create(User $user)
    {
        return $this->callUserMethod($user, 'createAffiliatePayout');
    }

    public function update(User $user, AffiliatePayout $affiliatePayout)
    {
        return $this->callUserMethod($user, 'updateAffiliatePayout', $affiliatePayout);
    }

    public function delete(User $user, AffiliatePayout $affiliatePayout)
    {
        return $this->callUserMethod($user, 'deleteAffiliatePayout', $affiliatePayout);
    }

    public function restore(User $user, AffiliatePayout $affiliatePayout)
    {
        return $this->callUserMethod($user, 'restoreAffiliatePayout', $affiliatePayout);
    }

    public function forceDelete(User $user, AffiliatePayout $affiliatePayout)
    {
        return $this->callUserMethod($user, 'forceDeleteAffiliatePayout', $affiliatePayout);
    }

    public function export(User $user)
    {
        return $this->callUserMethod($user, 'exportAffiliatePayout');
    }
}
