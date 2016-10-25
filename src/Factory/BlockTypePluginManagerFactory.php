<?php

namespace AtBlock\Factory;

use AtBlock\Block\Type\BlockTypePluginManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;

class BlockTypePluginManagerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $manager = new BlockTypePluginManager(
            $container,
            new Config($container->get('config')['atblock']['atblock_block_plugin_manager'])
        );

        return $manager;
    }
}