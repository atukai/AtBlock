<?php

namespace AtBlock\Block\Type;

use AtBlock\Entity\BlockInterface;

/**
 * Class Text
 * @package AtBlock\Block\Type
 */
class Text extends AbstractType
{
    /**
     * @return array
     */
    function getDefaultSettings()
    {
        return array(
            'content' => 'Insert your custom text here',
        );
    }

    /**
     * @param BlockInterface $block
     * @return mixed|string
     */
    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());
        return $settings['content'];
    }
}