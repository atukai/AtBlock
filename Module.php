<?php

namespace AtBlock;

use AtBlock\View\Helper\Block as BlockViewHelper;
use AtBlock\Block\Type;
use Zend\ModuleManager\ModuleManagerInterface;

class Module
{
    /**
     * @param \Zend\ModuleManager\ModuleManagerInterface $moduleManager
     */
    public function init(ModuleManagerInterface $moduleManager)
    {
        $moduleManager->loadModule('AtAdmin');
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
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
            'aliases' => array(
                'atblock_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
            ),

            'invokables' => array(
                'atblock_service_block' => 'AtBlock\Service\Block',
            ),

            'factories' => array(
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