<?php



namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\PullRequest;
use LoveOSS\Github\Entity\Repository;
use LoveOSS\Github\Entity\User;

class PullRequestEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;
    public $number;

    /**
     * @var PullRequest
     */
    public $pullRequest;

    /**
     * @var User
     */
    public $sender;

    public function getAction()
    {
        return $this->action;
    }

    public static function name()
    {
        return 'PullRequestEvent';
    }

    public static function fields()
    {
        return ['action', 'number', 'pull_request'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->number = $data['number'];
        $this->pullRequest = PullRequest::createFromData($data['pull_request']);
        $this->repository = Repository::createFromData($data['repository']);
        $this->sender = User::createFromData($data['sender']);

        return $this;
    }
}
