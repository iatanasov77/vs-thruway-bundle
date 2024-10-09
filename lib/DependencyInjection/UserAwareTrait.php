<?php namespace Vankosoft\ThruwayBundle\DependencyInjection;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @deprecated
 * Class UserAware
 * @package Vankosoft\ThruwayBundle\DependencyInjection
 */
Trait UserAwareTrait
{
    /**
     * @var
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user UserInterface
     * @return mixed|void
     */
    public function setUser( UserInterface $user )
    {
        $this->user = $user;
    }
}
