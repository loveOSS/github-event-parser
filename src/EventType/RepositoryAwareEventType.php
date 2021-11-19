<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Repository;
use LoveOSS\Github\Exception\RepositoryNotFoundException;

abstract class RepositoryAwareEventType extends AbstractEventType
{
    public Repository $repository;

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function createFromData(array $data): self
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
