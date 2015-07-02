<?php

namespace AtBlock\Entity;

/**
 *  Abstract Block class that provides a default implementation of the block interface
 */
class Block implements BlockInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @var boolean
     */
    protected $enabled = true;

    /**
     * @var integer
     */
    protected $position;

    /**
     * @var BlockInterface
     */
    protected $parent;

    /**
     * @var array
     */
    protected $children;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $type;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->settings = [];
        $this->children = [];
    }

    /**
     * @param $name
     * @return $this|string
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $type
     * @return $this|string
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array $settings
     * @return $this
     */
    public function setSettings(array $settings = array())
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @param null $key
     * @return array
     */
    public function getSettings($key = null)
    {
        if ($key && isset($this->settings[$key])) {
            return $this->settings[$key];
        }

        return $this->settings;
    }

    /**
     * @param $enabled
     * @return $this|bool
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param BlockInterface $child
     * @return $this
     */
    public function addChildren(BlockInterface $child)
    {
        $this->children[] = $child;
        $child->setParent($this);
        return $this;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param BlockInterface $parent
     * @return $this
     */
    public function setParent(BlockInterface $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return BlockInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return bool|void
     */
    public function hasParent()
    {
        return $this->getParent() != null;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('Block #%d : "%s"', $this->getId(), $this->getname());
    }
}