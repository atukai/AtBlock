<?php

namespace AtBlock\Service;

use AtBlock\Block\Type\BlockTypePluginManager;
use Zend\EventManager\EventManagerAwareTrait;
use AtBlock\Entity\Block;

class BlockService
{
    use EventManagerAwareTrait;

    /**
     * @var BlockTypePluginManager
     */
    protected $blockManager;

    /**
     * @var array
     */
    protected $typeInstances = [];

    /**
     * @param BlockTypePluginManager $manager
     */
    public function __construct(BlockTypePluginManager $manager)
    {
        $this->blockManager = $manager;
    }

    /**
     * @param $type
     * @param $settings
     * @return BlockEntity
     */
    public function create($type, $settings)
    {
        $block = new Block();
        $block->setType($type);
        $block->setSettings($settings);
        $block->setEnabled(true);
        $block->setCreatedAt(new \DateTime());
        $block->setUpdatedAt(new \DateTime());

        return $block;
    }

    /**
     * @param Block $block
     * @return mixed
     */
    public function getTypeInstance(Block $block)
    {
        $type = $block->getType();

        if (! isset($this->typeInstances[$type])) {
            $typeInstance = $this->blockManager->get($type);
            $this->typeInstances[$type] = $typeInstance;
        }

        return $this->typeInstances[$type];
    }
}