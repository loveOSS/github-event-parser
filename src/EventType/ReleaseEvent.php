<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Release;
use LoveOSS\Github\Entity\User;

class ReleaseEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public string $action;

    public Release $release;

    public function getAction(): string
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

    public function createFromData(array $data): self
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
