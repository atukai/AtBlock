<?php

namespace AtBlock\Block\Type;

use AtBlock\Entity\BlockInterface;

interface TypeInterface
{
    /**
     * Returns the default settings link to the service
     *
     * @return array
     */
    public function getDefaultSettings();

    /**
     * @param BlockInterface $block
     * @return mixed
     */
    public function execute(BlockInterface $block);
}