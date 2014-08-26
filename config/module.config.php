<?php

use AtBlock\Block\Type;

return array(
    'atblock' => array(
        'atblock_block_plugin_manager' => array(
            'factories' => array(
                'atblock_block_type_text' => function () {
                    return new Type\Text();
                },

                'atblock_block_type_template' => function ($pluginManager) {
                    return new Type\Template($pluginManager->getServiceLocator()->get('ViewRenderer'));
                },

                'atblock_block_type_rss' => function ($pluginManager) {
                    return new Type\Rss($pluginManager->getServiceLocator()->get('ViewRenderer'));
                },
            )
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);