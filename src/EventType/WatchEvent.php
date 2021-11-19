<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class WatchEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public string $action;

    public User $user;

    public function getAction(): string
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

    public static function isValid(array $data): bool
    {
        return array_key_exists('action', $data) && $data['action'] === 'started';
    }

    public function createFromData(array $data): self
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->user = User::createFromData($data['sender']);

        return $this;
    }
}
