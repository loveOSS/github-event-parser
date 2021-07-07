<?php



namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Page;
use LoveOSS\Github\Entity\User;

class GollumEvent extends RepositoryAwareEventType
{
    /**
     * @var array
     */
    public $pages;

    /**
     * @var User
     */
    public $sender;

    public static function name()
    {
        return 'GollumEvent';
    }

    public static function fields()
    {
        return ['pages'];
    }

    public function createFromData($data)
    {
        parent::createFromData($data);

        $this->sender = User::createFromData($data['sender']);
        $this->pages = $this->parsePages($data['pages']);

        return $this;
    }

    private function parsePages(array $arrayPages)
    {
        $pages = [];
        foreach ($arrayPages as $pageEntry) {
            $pages[] = Page::createFromData($pageEntry);
        }

        return $pages;
    }
}
