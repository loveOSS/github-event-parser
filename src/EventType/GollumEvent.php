<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Page;
use LoveOSS\Github\Entity\User;

class GollumEvent extends RepositoryAwareEventType
{
    public array $pages;

    public User $sender;

    public static function name(): string
    {
        return 'GollumEvent';
    }

    public static function fields(): array
    {
        return ['pages'];
    }

    public function createFromData($data): self
    {
        parent::createFromData($data);

        $this->sender = User::createFromData($data['sender']);
        $this->pages = $this->parsePages($data['pages']);

        return $this;
    }

    private function parsePages(array $arrayPages): array
    {
        $pages = [];
        foreach ($arrayPages as $pageEntry) {
            $pages[] = Page::createFromData($pageEntry);
        }

        return $pages;
    }
}
