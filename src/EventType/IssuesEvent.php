<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Issue;
use LoveOSS\Github\Entity\Label;
use LoveOSS\Github\Entity\Repository;
use LoveOSS\Github\Entity\User;

class IssuesEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    public ?User $assignee;

    public Issue $issue;

    public ?Label $label;

    public User $sender;

    public function getAction()
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'IssuesEvent';
    }

    public static function fields(): array
    {
        return ['action', 'issue'];
    }

    public function createFromData($data): self
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

    public function isAssigned(): bool
    {
        return 'assigned' === $this->action;
    }

    public function isUnassigned(): bool
    {
        return 'unassigned' === $this->action;
    }

    public function isLabeled(): bool
    {
        return 'labeled' === $this->action;
    }

    public function isUnlabeled(): bool
    {
        return 'unlabeled' === $this->action;
    }

    public function isOpened(): bool
    {
        return 'opened' === $this->action;
    }

    public function isClosed(): bool
    {
        return 'closed' === $this->action;
    }

    public function isReopened(): bool
    {
        return 'reopened' === $this->action;
    }
}
