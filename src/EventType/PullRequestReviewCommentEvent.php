<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Comment;
use LoveOSS\Github\Entity\PullRequest;
use LoveOSS\Github\Entity\User;

class PullRequestReviewCommentEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    public Comment $comment;

    public PullRequest $pullRequest;

    public User $sender;

    public function getAction()
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'PullRequestReviewCommentEvent';
    }

    public static function fields(): array
    {
        return ['action', 'comment', 'pull_request'];
    }

    public static function isValid($data): bool
    {
        return parent::isValid($data) && $data['action'] === 'created';
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->comment = Comment::createFromData($data['comment']);
        $this->pullRequest = PullRequest::createFromData($data['pull_request']);
        $this->sender = User::createFromData($data['comment']['user']);

        return $this;
    }
}
