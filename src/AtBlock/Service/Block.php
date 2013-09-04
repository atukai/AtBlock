<?php

namespace AtBlock\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;
use AtBlock\Entity\Block as BlockEntity;

class Block extends EventProvider implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var array
     */
    protected $typeInstances = array();

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