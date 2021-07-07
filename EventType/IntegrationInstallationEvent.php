<?php



namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class IntegrationInstallationEvent extends AbstractEventType implements ActionableEventInterface
{
    /**
     * @var string
     */
    public $action;

    /**
     * @var User
     */
    public $sender;

    /**
     * {@inheritdoc}
     */
    public function getAction()
    {
        return $this->action;
    }

    public static function name()
    {
        return 'IntegrationInstallationEvent';
    }

    public static function fields()
    {
        return ['action', 'installation'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->sender = User::createFromData($data['sender']);

        return $this;
    }
}
