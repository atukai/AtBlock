<?php

namespace AtBlock\Block\Type;

use AtBlock\Entity\BlockInterface;
use AtBlock\Block\Type\TypeInterface;

/**
 *
 */
class Text implements TypeInterface
{
    /**
     * {@inheritdoc}
     */
    function getDefaultSettings()
    {
        return array(
            'content' => 'Insert your custom text here',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());
        return $settings['content'];
    }
}