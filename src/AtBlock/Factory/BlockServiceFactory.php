<?php

namespace AtBlock\Factory;

use AtBlock\Service\BlockService;
use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlockServiceFactory extends AbstractPluginManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new BlockService($serviceLocator->get('AtBlock\BlockTypePluginManager'));
    }
}