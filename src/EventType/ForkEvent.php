<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Repository;
use LoveOSS\Github\Entity\User;

class ForkEvent extends RepositoryAwareEventType
{
    /**
     * @var Repository
     */
    public $forkedRepository;

    /**
     * @var User
     */
    public $owner;

    /**
     * @var User
     */
    public $forker;

    public static function name()
    {
        return 'ForkEvent';
    }

    public static function fields()
    {
        return ['forkee'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->forkedRepository = Repository::createFromData($data['forkee']);
        $this->owner = $this->forkedRepository->getOwner();
        $this->forker = $this->repository->getOwner();

        return $this;
    }
}
