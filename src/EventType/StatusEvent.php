<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\User;

class StatusEvent extends RepositoryAwareEventType
{
    public $branches;

    public User $committer;
    public string $description;
    public string $sha;
    public string $state;
    public string $targetUrl;

    public static function name(): string
    {
        return 'StatusEvent';
    }

    public static function fields(): array
    {
        return ['sha', 'state', 'description', 'target_url', 'branches'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->branches = $data['branches'];
        $this->committer = User::createFromData($data['commit']['committer']);
        $this->description = (string) $data['description'];
        $this->sha = (string) $data['sha'];
        $this->state = (string) $data['state'];
        $this->targetUrl = (string) $data['target_url'];

        return $this;
    }
}
