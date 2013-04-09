<?php

namespace AtBlock\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class Block extends AbstractDbMapper implements BlockInterface
{
    /**
     * @var string
     */
    protected $tableName  = 'cms_page_block';

    /**
     * @param $id
     * @return object
     */
    public function findById($id)
    {
        $select = $this->getSelect()->where(array('block_id' => (int) $id));
        $entity = $this->select($select)->current();

        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));

        return $entity;
    }

    /**
     * @param $identifier
     * @return object
     */
    public function findByIdentifier($identifier)
    {
        $select = $this->getSelect()->where(array('identifier' => (string) $identifier));
        $entity = $this->select($select)->current();

        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));

        return $entity;
    }

    /**
     * Find entity by integer id or string identifier
     *
     * @param $identifier
     * @return object
     * @throws \Exception
     */
    public function find($identifier)
    {
        if (is_int($identifier)) {
            $entity = $this->findById($identifier);
        } elseif (is_string($identifier)) {
            $entity = $this->findByIdentifier($identifier);
        } else {
            throw new \Exception('Wrong block identifier provided.');
        }

        return $entity;
    }

    /**
     * @param array|object $entity
     * @param null $tableName
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setId($result->getGeneratedValue());

        return $result;
    }

    /**
     * @param array|object $entity
     * @param null $where
     * @param null $tableName
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'block_id = ' . $entity->getId();
        }

        return parent::update($entity, $where, $tableName, $hydrator);
    }
}