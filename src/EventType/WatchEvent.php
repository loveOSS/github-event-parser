<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class WatchEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    public User $user;

    public function getAction()
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'WatchEvent';
    }

    public static function fields(): array
    {
        return ['action'];
    }

    public static function isValid($data): bool
    {
        if (array_key_exists('action', $data) && $data['action'] === 'started') {
            return true;
        }

        return false;
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->user = User::createFromData($data['sender']);

        return $this;
    }
}
