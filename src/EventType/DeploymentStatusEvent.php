<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Deployment;
use LoveOSS\Github\Entity\User;

class DeploymentStatusEvent extends RepositoryAwareEventType
{
    /**
     * @var Deployment
     */
    public $deployment;

    public ?\LoveOSS\Github\Entity\User $sender = null;

    public static function name(): string
    {
        return 'DeploymentStatusEvent';
    }

    public static function fields(): array
    {
        return ['deployment_status', 'deployment', 'repository'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->deployment = Deployment::createFromData($data['deployment']);
        $this->sender = User::createFromData($data['sender']);

        return $this;
    }
}
