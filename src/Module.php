<?php

namespace AtBlock;

use AtBlock\Block\Type\BlockTypePluginManager;
use AtBlock\Factory\BlockServiceFactory;
use AtBlock\Factory\BlockTypePluginManagerFactory;
use AtBlock\Service\BlockService;
use AtBlock\View\Helper\Block as BlockViewHelper;

class Module
{
    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                BlockTypePluginManager::class => BlockTypePluginManagerFactory::class,
                Service\BlockService::class => BlockServiceFactory::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'atBlock' => function($pluginManager) {
                    $viewHelper = new BlockViewHelper();
                    $viewHelper->setBlockService($pluginManager->getServiceLocator()->get(BlockService::class));

                    return $viewHelper;
                },
            ],
        ];
    }
}