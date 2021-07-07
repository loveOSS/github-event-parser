<?php



namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Comment;
use LoveOSS\Github\Entity\PullRequest;
use LoveOSS\Github\Entity\User;

class PullRequestReviewCommentEvent extends RepositoryAwareEventType implements ActionableEventInterface
{
    public $action;

    /**
     * @var Comment
     */
    public $comment;

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
        return 'PullRequestReviewCommentEvent';
    }

    public static function fields()
    {
        return ['action', 'comment', 'pull_request'];
    }

    public static function isValid($data)
    {
        if (parent::isValid($data)) {
            if ($data['action'] === 'created') {
                return true;
            }
        }

        return false;
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->action = $data['action'];
        $this->comment = Comment::createFromData($data['comment']);
        $this->pullRequest = PullRequest::createFromData($data['pull_request']);
        $this->sender = User::createFromData($data['comment']['user']);

        return $this;
    }
}
