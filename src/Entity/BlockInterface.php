<?php

namespace AtBlock\Entity;

/**
 *
 */
interface BlockInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $type
     * @return mixed
     */
    public function setType($type);

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @param $enabled
     * @return mixed
     */
    public function setEnabled($enabled);

    /**
     * @return mixed
     */
    public function getEnabled();

    /**
     * @param \DateTime $createdAt
     * @return mixed
     */
    public function setCreatedAt(\DateTime $createdAt = null);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $updatedAt
     * @return mixed
     */
    public function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * Sets the block settings
     *
     * @param array $settings An array of key/value
     */
    public function setSettings(array $settings = []);

    /**
     * Returns the block settings
     *
     * @return array $settings An array of key/value
     */
    public function getSettings();

    /**
     * Add one child block
     *
     * @param BlockInterface $children
     */
    public function addChildren(BlockInterface $children);

    /**
     * Returns child blocks
     */
    public function getChildren();

    /**
     * Returns whether or not this block has children
     *
     * @return boolean
     */
    public function hasChildren();

    /**
     * Set the parent block
     *
     * @param BlockInterface|null $parent
     */
    public function setParent(BlockInterface $parent = null);

    /**
     * Returns the parent block
     *
     * @return BlockInterface $parent
     */
    public function getParent();

    /**
     * Returns whether or not this block has a parent
     *
     * @return void
     */
    public function hasParent();
}