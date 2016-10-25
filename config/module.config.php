<?php

use AtBlock\Block\Type;

return [
    'atblock' => [
        'atblock_block_plugin_manager' => [
            'factories' => [
                'atblock_block_type_text' => function () {
                    return new Type\Text();
                },

                'atblock_block_type_template' => function ($pluginManager) {
                    return new Type\Template($pluginManager->getServiceLocator()->get('ViewRenderer'));
                },
            ]
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];