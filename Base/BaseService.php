<?php

namespace GenyBundle\Base;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class BaseService
{
    use ContainerAwareTrait;

    public function get($service)
    {
        return $this->container->get($service);
    }

    public function getParameter($parameter)
    {
        return $this->container->getParameter($parameter);
    }
}
