<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class PushEvent extends RepositoryAwareEventType
{
    public $before;
    public $commits;
    public $distinctSize;
    public $head;
    public $pusher;
    public $ref;

    /**
     * @var User
     */
    public $sender;
    public $size;

    public static function name()
    {
        return 'PushEvent';
    }

    public static function fields()
    {
        return ['ref', 'head', 'before', 'commits'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->before = $data['before'];
        $this->commits = $data['commits'];
        $this->distinctSize = $data['distinct_size'];
        $this->head = $data['head'];
        $this->pusher = $data['pusher']['name'];
        $this->ref = $data['ref'];
        $this->sender = User::createFromData($data['sender']);
        $this->size = $data['size'];

        return $this;
    }
}
