<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Repository;
use LoveOSS\Github\Exception\RepositoryNotFoundException;

abstract class RepositoryAwareEventType extends AbstractEventType
{
    /**
     * @var Repository
     */
    public $repository;

    /**
     * @return Repository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        try {
            $this->repository = Repository::createFromData($data['repository']);
        } catch (\Exception $e) {
            throw new RepositoryNotFoundException($e->getMessage());
        }

        return $this;
    }
}
