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

    public ?\LoveOSS\Github\Entity\User $forker = null;

    public static function name(): string
    {
        return 'ForkEvent';
    }

    public static function fields(): array
    {
        return ['forkee'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->forkedRepository = Repository::createFromData($data['forkee']);
        $this->owner = $this->forkedRepository->getOwner();
        $this->forker = $this->repository->getOwner();

        return $this;
    }
}
