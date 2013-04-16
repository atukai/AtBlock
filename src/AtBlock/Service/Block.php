<?php

namespace AtBlock\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;
use AtBlock\Mapper\BlockInterface as BlockMapperInterface;
use AtBlock\Entity\Block as BlockEntity;

/**
 * Class Block
 * @package AtBlock\Service
 */
class Block extends EventProvider implements ServiceManagerAwareInterface
{
    /**
     * @var BlockMapperInterface
     */
    protected $blockMapper;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var array
     */
    protected $typeInstances = array();

    /**
     * @return BlockMapperInterface
     */
    public function getBlockMapper()
    {
        if (null === $this->blockMapper) {
            $this->blockMapper = $this->getServiceManager()->get('atblock_block_mapper');
        }
        return $this->blockMapper;
    }

    /**
     * @param BlockMapperInterface $blockMapper
     * @return $this
     */
    public function setBlockMapper(BlockMapperInterface $blockMapper)
    {
        $this->blockMapper = $blockMapper;
        return $this;
    }

    /**
     * @param ServiceManager $serviceManager
     * @return $this
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * @param $type
     * @param $settings
     * @return BlockEntity
     */
    public function create($type, $settings)
    {
        $block = new BlockEntity();
        $block->setId(uniqid());
        $block->setType($type);
        $block->setSettings($settings);
        $block->setEnabled(true);
        $block->setCreatedAt(new \DateTime());
        $block->setUpdatedAt(new \DateTime());

        return $block;
    }

    /**
     * @param BlockEntity $block
     * @return array|object
     */
    public function getTypeInstance(BlockEntity $block)
    {
        $type = $block->getType();

        if (! isset($this->typeInstances[$type])) {
            $typeInstance = $this->serviceManager->get($type);
            $this->typeInstances[$type] = $typeInstance;
        }

        return $this->typeInstances[$type];
    }
}