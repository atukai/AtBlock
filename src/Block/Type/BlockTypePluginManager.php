<?php

namespace AtBlock\Block\Type;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;

class BlockTypePluginManager extends AbstractPluginManager
{
    protected $instanceOf = TypeInterface::class;

    /**
     * @param mixed $plugin
     */
    public function validatePlugin($plugin)
    {
        $this->validate($plugin);
    }

    /**
     * @param mixed $plugin
     */
    public function validate($plugin)
    {
        if ($plugin instanceof TypeInterface) {
            return;
        }

        throw new InvalidServiceException(sprintf(
            'Block type must implement "AtBlock\Block\Type\TypeInterface", but "%s" was given',
            is_object($plugin) ? get_class($plugin) : gettype($plugin)
        ));
    }
}