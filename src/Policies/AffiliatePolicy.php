<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliatePolicy
{
    use HandlesAuthorization;

    /**
     * Permite todo a admins, excepto habilidades explícitamente excluidas.
     */
    public function before($user, $ability)
    {
        $exceptAbilities = config('affiliate.permissions.affiliate-except-abilities', []);

        if (method_exists($user, 'isAdmin') && $user->isAdmin() && !in_array($ability, $exceptAbilities)) {
            return true;
        }
    }

    /**
     * Llama dinámicamente al método del usuario si existe.
     */
    protected function callUserMethod(User $user, string $method, ...$arguments): bool
    {
        return method_exists($user, $method) ? $user->{$method}(...$arguments) : false;
    }

    public function index(User $user)
    {
        return $this->callUserMethod($user, 'indexAffiliate');
    }

    public function viewAny(User $user)
    {
        return $this->callUserMethod($user, 'viewAnyAffiliate');
    }

    public function view(User $user, Affiliate $affiliate)
    {
        return $this->callUserMethod($user, 'viewAffiliate', $affiliate);
    }

    public function create(User $user)
    {
        return $this->callUserMethod($user, 'createAffiliate');
    }

    public function update(User $user, Affiliate $affiliate)
    {
        return $this->callUserMethod($user, 'updateAffiliate', $affiliate);
    }

    public function delete(User $user, Affiliate $affiliate)
    {
        return $this->callUserMethod($user, 'deleteAffiliate', $affiliate);
    }

    public function restore(User $user, Affiliate $affiliate)
    {
        return $this->callUserMethod($user, 'restoreAffiliate', $affiliate);
    }

    public function forceDelete(User $user, Affiliate $affiliate)
    {
        return $this->callUserMethod($user, 'forceDeleteAffiliate', $affiliate);
    }

    public function export(User $user)
    {
        return $this->callUserMethod($user, 'exportAffiliate');
    }
}
