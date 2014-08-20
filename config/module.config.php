<?php

use AtBlock\Block\Type;

return array(
    'atblock_plugin_manager' => array(
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
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);