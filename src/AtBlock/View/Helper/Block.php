<?php

namespace AtBlock\View\Helper;

use Zend\View\Helper\AbstractHelper;
use AtBlock\Entity\BlockInterface;
use AtBlock\Service\Block as BlockService;

/**
 * Class Block
 * @package AtBlock\View\Helper
 */
class Block extends AbstractHelper
{
    /**
     * @var BlockService
     */
    protected $blockService;

    /**
     * @param $type
     * @param array $settings
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($type, $settings = array())
    {
        $block = $this->blockService->create($type, $settings);
        if (!$block || (! $block instanceof BlockInterface)) {
            throw new \Exception('Block of "' . $type . '" type couldn\'t be create');
        }

        $typeInstance = $this->blockService->getTypeInstance($block);
        return $typeInstance->execute($block);
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