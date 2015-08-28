<?php

namespace AtBlock;

use AtBlock\View\Helper\Block as BlockViewHelper;
use AtBlock\Block\Type;

class Module
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'AtBlock\BlockTypePluginManager' => 'AtBlock\Factory\BlockTypePluginManagerFactory',
                'atblock_service_block' => 'AtBlock\Factory\BlockServiceFactory',
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
                    $viewHelper->setBlockService($pluginManager->getServiceLocator()->get('atblock_service_block'));

                    return $viewHelper;
                },
            ],
        ];
    }
}