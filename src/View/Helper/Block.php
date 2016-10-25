<?php

namespace AtBlock\View\Helper;

use Zend\View\Helper\AbstractHelper;
use AtBlock\Entity\BlockInterface;
use AtBlock\Service\BlockService;

class Block extends AbstractHelper
{
    /**
     * @var BlockService
     */
    protected $blockService;

    /**
     * @param string|BlockInterface $type
     * @param array $settings
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($type, $settings = [])
    {
        if (! $type instanceof BlockInterface) {
            $block = $this->blockService->create($type, $settings);
        }

        if (!$block || (! $block instanceof BlockInterface)) {
            throw new \Exception('Block of "' . $type . '" type couldn\'t be created');
        }

        return $this->blockService->getTypeInstance($block)->execute($block);
    }

    /**
     * @param BlockService $blockService
     * @return $this
     */
    public function setBlockService(BlockService $blockService)
    {
        $this->blockService = $blockService;
        return $this;
    }
}