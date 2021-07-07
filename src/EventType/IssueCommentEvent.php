<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Comment;
use LoveOSS\Github\Entity\Issue;
use LoveOSS\Github\Entity\User;

class IssueCommentEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    /**
     * @var Issue
     */
    public $issue;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Comment
     */
    public $comment;

    public function getAction()
    {
        return $this->action;
    }

    public static function name()
    {
        return 'IssueCommentEvent';
    }

    public static function fields()
    {
        return ['action', 'issue', 'comment'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->issue = Issue::createFromData($data['issue']);
        $this->comment = Comment::createFromData($data['comment']);
        $this->user = $this->comment->getUser();

        return $this;
    }
}
