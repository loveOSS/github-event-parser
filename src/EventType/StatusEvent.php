<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class StatusEvent extends RepositoryAwareEventType
{
    public $branches;

    /**
     * @var User
     */
    public $committer;
    public $description;
    public $sha;
    public $state;
    public $targetUrl;

    public static function name()
    {
        return 'StatusEvent';
    }

    public static function fields()
    {
        return ['sha', 'state', 'description', 'target_url', 'branches'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->branches = $data['branches'];
        $this->committer = User::createFromData($data['commit']['committer']);
        $this->description = $data['description'];
        $this->sha = $data['sha'];
        $this->state = $data['state'];
        $this->targetUrl = $data['target_url'];

        return $this;
    }
}
