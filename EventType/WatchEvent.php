<?php



namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class WatchEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    /**
     * @var User
     */
    public $user;

    public function getAction()
    {
        return $this->action;
    }

    public static function name()
    {
        return 'WatchEvent';
    }

    public static function fields()
    {
        return ['action'];
    }

    public static function isValid($data)
    {
        if (array_key_exists('action', $data) && $data['action'] === 'started') {
            return true;
        }

        return false;
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->user = User::createFromData($data['sender']);

        return $this;
    }
}
