<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Comment;
use LoveOSS\Github\Entity\Issue;
use LoveOSS\Github\Entity\User;

class IssueCommentEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    public Issue $issue;

    public User $user;

    public Comment $comment;

    public function getAction()
    {
        return $this->action;
    }

    public static function name(): string
    {
        return 'IssueCommentEvent';
    }

    public static function fields(): array
    {
        return ['action', 'issue', 'comment'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->issue = Issue::createFromData($data['issue']);
        $this->comment = Comment::createFromData($data['comment']);
        $this->user = $this->comment->getUser();

        return $this;
    }
}
