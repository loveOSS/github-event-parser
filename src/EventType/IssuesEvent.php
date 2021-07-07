<?php



namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Issue;
use LoveOSS\Github\Entity\Label;
use LoveOSS\Github\Entity\Repository;
use LoveOSS\Github\Entity\User;

class IssuesEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    /**
     * @var User|null
     */
    public $assignee;

    /**
     * @var Issue
     */
    public $issue;

    /**
     * @var Label|null
     */
    public $label;

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
        return 'IssuesEvent';
    }

    public static function fields()
    {
        return ['action', 'issue'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->assignee = isset($data['assignee']) ? User::createFromData($data['assignee']) : null;
        $this->label = isset($data['label']) ? Label::createFromData($data['label']) : null;
        $this->issue = Issue::createFromData($data['issue']);
        $this->repository = Repository::createFromData($data['repository']);
        $this->sender = User::createFromData($data['sender']);

        return $this;
    }

    public function isAssigned()
    {
        return 'assigned' === $this->action;
    }

    public function isUnassigned()
    {
        return 'unassigned' === $this->action;
    }

    public function isLabeled()
    {
        return 'labeled' === $this->action;
    }

    public function isUnlabeled()
    {
        return 'unlabeled' === $this->action;
    }

    public function isOpened()
    {
        return 'opened' === $this->action;
    }

    public function isClosed()
    {
        return 'closed' === $this->action;
    }

    public function isReopened()
    {
        return 'reopened' === $this->action;
    }
}
