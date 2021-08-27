<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class IntegrationInstallationEvent extends AbstractEventType implements ActionableEventInterface
{
    public string $action;

    public User $sender;

    /**
     * {@inheritdoc}
     */
    public function getAction()
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'IntegrationInstallationEvent';
    }

    public static function fields(): array
    {
        return ['action', 'installation'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->sender = User::createFromData($data['sender']);

        return $this;
    }
}
