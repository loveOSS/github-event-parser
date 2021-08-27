<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class IntegrationInstallationRepositoriesEvent extends AbstractEventType implements ActionableEventInterface
{
    public $action;

    public User $sender;

    public string $repositorySelection;

    public array $repositoryAdded;

    public array $repositoryRemoved;

    public function getAction(): string
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'IntegrationInstallationRepositoriesEvent';
    }

    public static function fields(): array
    {
        return ['action', 'installation', 'repository_selection', 'repositories_added', 'repositories_removed'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->sender = User::createFromData($data['sender']);

        $this->repositorySelection = $data['repository_selection'];
        $this->repositoryAdded = $data['repositories_added'];
        $this->repositoryRemoved = $data['repositories_removed'];

        return $this;
    }
}
