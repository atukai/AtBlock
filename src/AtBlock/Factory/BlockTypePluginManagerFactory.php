<?php

namespace AtBlock\Factory;

use AtBlock\Block\Type\BlockTypePluginManager;
use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceLocatorInterface;

class BlockTypePluginManagerFactory extends AbstractPluginManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $manager = new BlockTypePluginManager(
            new Config($serviceLocator->get('config')['atblock']['atblock_block_plugin_manager'])
        );
        $manager->setServiceLocator($serviceLocator);

        return $manager;
    }
}