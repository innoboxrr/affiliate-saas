<?php

namespace Innoboxrr\AffiliateSaas\Policies;

use App\Models\User;
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffiliateProgramPolicy
{
    use HandlesAuthorization;

    /**
     * Permite todo a admins, excepto habilidades explícitamente excluidas.
     */
    public function before($user, $ability)
    {
        $exceptAbilities = config('affiliate.permissions.affiliate-program-except-abilities', []);

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
        return $this->callUserMethod($user, 'indexAffiliateProgram');
    }

    public function viewAny(User $user)
    {
        return $this->callUserMethod($user, 'viewAnyAffiliateProgram');
    }

    public function view(User $user, AffiliateProgram $affiliateProgram)
    {
        return $this->callUserMethod($user, 'viewAffiliateProgram', $affiliateProgram);
    }

    public function create(User $user)
    {
        return $this->callUserMethod($user, 'createAffiliateProgram');
    }

    public function update(User $user, AffiliateProgram $affiliateProgram)
    {
        return $this->callUserMethod($user, 'updateAffiliateProgram', $affiliateProgram);
    }

    public function delete(User $user, AffiliateProgram $affiliateProgram)
    {
        return $this->callUserMethod($user, 'deleteAffiliateProgram', $affiliateProgram);
    }

    public function restore(User $user, AffiliateProgram $affiliateProgram)
    {
        return $this->callUserMethod($user, 'restoreAffiliateProgram', $affiliateProgram);
    }

    public function forceDelete(User $user, AffiliateProgram $affiliateProgram)
    {
        return $this->callUserMethod($user, 'forceDeleteAffiliateProgram', $affiliateProgram);
    }

    public function export(User $user)
    {
        return $this->callUserMethod($user, 'exportAffiliateProgram');
    }
}
