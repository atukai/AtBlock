<?php

namespace AtBlock\View\Helper;

use AtBlock\Block\BlockServiceInterface;
use AtBlock\Block\Type\TypeInterface;
use Zend\View\Helper\AbstractHelper;
use AtBlock\Service\Block as BlockService;
use AtBlock\Block\BlockRendererInterface;

class Block extends AbstractHelper
{
    /**
     * @var BlockServiceInterface
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
        if (!$block) {
            throw new \Exception('Block of "' . $type . '" type couldn\'t be create');
        }

        /** @var \AtCms\Block\Type\TypeInterface $typeService  */
        $typeService = $this->blockService->getTypeService($block);
        return $typeService->execute($block);
    }

    /**
     * @param \AtCms\Service\Block $blockService
     * @return $this
     */
    public function setBlockService(BlockService $blockService)
    {
        $this->blockService = $blockService;
        return $this;
    }

    /**
     * @param $blockService
     * @return $this
     */
    public function setBlockRenderer(BlockRendererInterface $renderer)
    {
        $this->blockRenderer = $renderer;
        return $this;
    }
}