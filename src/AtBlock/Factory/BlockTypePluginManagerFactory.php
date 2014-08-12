<?php

namespace AtBlock\Factory;

use AtBlock\Block\Type\BlockTypePluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ResolversPluginManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $manager = new BlockTypePluginManager();
        $manager->setServiceLocator($serviceLocator);

        return $manager;
    }
}