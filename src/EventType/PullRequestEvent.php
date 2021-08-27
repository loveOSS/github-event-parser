<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\PullRequest;
use LoveOSS\Github\Entity\Repository;
use LoveOSS\Github\Entity\User;

class PullRequestEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    public $number;

    public PullRequest $pullRequest;

    public User $sender;

    public function getAction()
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'PullRequestEvent';
    }

    public static function fields(): array
    {
        return ['action', 'number', 'pull_request'];
    }

    public function createFromData($data): self
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
