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
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
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
        return array(
            'invokables' => array(

            ),

            'factories' => array(
                'atblock_service_block' => 'AtBlock\Factory\BlockServiceFactory',
                'AtBlock\BlockTypePluginManager' => 'AtBlock\Factory\BlockTypePluginManagerFactory',
            ),
        );
    }

    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'atBlock' => function($pluginManager) {
                    $viewHelper = new BlockViewHelper();
                    $viewHelper->setBlockService($pluginManager->getServiceLocator()->get('atblock_service_block'));

                    return $viewHelper;
                },
            ),
        );
    }
}