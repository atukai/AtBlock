<?php

namespace AtBlock\Block\Type;

use Zend\ServiceManager\AbstractPluginManager;

class BlockTypePluginManager extends AbstractPluginManager
{
    /**
     * @param mixed $plugin
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof TypeInterface) {
            return;
        }

        throw new \RuntimeException(sprintf(
            'Resolver must implement "AtBlock\Block\Type\TypeInterface", but "%s" was given',
            is_object($plugin) ? get_class($plugin) : gettype($plugin)
        ));
    }
}