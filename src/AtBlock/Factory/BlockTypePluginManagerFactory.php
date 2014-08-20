<?php

namespace AtBlock\Factory;

use AtBlock\Block\Type\BlockTypePluginManager;
use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ResolversPluginManagerFactory extends AbstractPluginManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $manager = new BlockTypePluginManager();
        $manager->setServiceLocator($serviceLocator);

        return $manager;
    }
}