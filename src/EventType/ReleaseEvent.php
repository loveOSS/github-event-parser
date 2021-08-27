<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Release;
use LoveOSS\Github\Entity\User;

class ReleaseEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    public Release $release;

    public function getAction()
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'ReleaseEvent';
    }

    public static function fields(): array
    {
        return ['action', 'release', 'sender', 'repository'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $sender = User::createFromData($data['sender']);
        $this->release = Release::createFromData(
            $data['release'],
            $this->repository,
            $sender
        );

        return $this;
    }
}
