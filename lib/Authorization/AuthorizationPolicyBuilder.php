<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Security\Authorization;

class AuthorizationPolicyBuilder
{
    private string $name;
    private array $requirements = [];

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->requirements[] = new AuthenticationRequirement();
    }

    public function addRequirement(IAuthorizationRequirement $requirement): void
    {
        $this->requirements[] = $requirement;
    }

    public function requireClaim(string $claimType, array $allowedValues = []): void
    {
        $this->requirements[] = new ClaimsRequirement($claimType, $allowedValues);
    }

    public function requireRole(array $roles): void
    {
        $this->requirements[] = new RolesRequirement($roles);
    }

    public function build(): AuthorizationPolicy
    {
        return new AuthorizationPolicy($this->name, $this->requirements);
    }
}
