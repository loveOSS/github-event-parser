<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class IntegrationInstallationRepositoriesEvent extends AbstractEventType implements ActionableEventInterface
{
    public $action;

    /**
     * @var User
     */
    public $sender;

    /**
     * @var string
     */
    public $repositorySelection;

    /**
     * @var array
     */
    public $repositoryAdded;

    /**
     * @var array
     */
    public $repositoryRemoved;

    /**
     * @return string action name
     */
    public function getAction()
    {
        return $this->action;
    }

    public static function name()
    {
        return 'IntegrationInstallationRepositoriesEvent';
    }

    public static function fields()
    {
        return ['action', 'installation', 'repository_selection', 'repositories_added', 'repositories_removed'];
    }

    public function createFromData($data)
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
