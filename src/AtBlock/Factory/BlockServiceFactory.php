<?php

namespace AtBlock\Factory;

use AtBlock\Service\BlockService;
use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlockServiceFactory extends AbstractPluginManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new BlockService();
        $service->setBlockManager($serviceLocator->get('AtBlock\BlockTypePluginManager'));

        return $service;
    }
}