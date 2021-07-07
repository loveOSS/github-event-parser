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

    /**
     * @var User
     */
    public $sender;

    public static function name()
    {
        return 'DeploymentStatusEvent';
    }

    public static function fields()
    {
        return ['deployment_status', 'deployment', 'repository'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->deployment = Deployment::createFromData($data['deployment']);
        $this->sender = User::createFromData($data['sender']);

        return $this;
    }
}
