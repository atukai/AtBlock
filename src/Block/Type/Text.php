<?php

namespace AtBlock\Block\Type;

use AtBlock\Entity\BlockInterface;

class Text extends AbstractType
{
    /**
     * @return array
     */
    function getDefaultSettings()
    {
        return [
            'content' => 'Insert your custom text here',
        ];
    }

    /**
     * @param BlockInterface $block
     * @return mixed
     */
    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());
        return $settings['content'];
    }
}