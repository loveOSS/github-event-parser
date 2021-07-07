<?php



namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Release;
use LoveOSS\Github\Entity\User;

class ReleaseEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    /**
     * @var Release
     */
    public $release;

    public function getAction()
    {
        return $this->action;
    }

    public static function name()
    {
        return 'ReleaseEvent';
    }

    public static function fields()
    {
        return ['action', 'release', 'sender', 'repository'];
    }

    public function createFromData($data)
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
