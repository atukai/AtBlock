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
                'atblock_service_block' => 'AtBlock\Service\Block',
            ),

            'factories' => array(
                'AtBlock\BlockTypePluginManager' => 'AtBlock\Factory\BlockTypePluginManagerFactory',

                'atblock_block_type_text' => function () {
                    return new Type\Text();
                },

                'atblock_block_type_template' => function ($sm) {
                    return new Type\Template($sm->get('ViewRenderer'));
                },

                'atblock_block_type_rss' => function ($sm) {
                    return new Type\Rss($sm->get('ViewRenderer'));
                },
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
                'atBlock' => function($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new BlockViewHelper();
                    $viewHelper->setBlockService($locator->get('atblock_service_block'));
                    return $viewHelper;
                },
            ),
        );
    }
}