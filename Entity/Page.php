<?php



namespace LoveOSS\Github\Entity;

class Page
{
    private $pageName;
    private $title;
    private $summary;
    private $action;
    private $sha;
    private $htmlUrl;

    public static function createFromData(array $data)
    {
        return new static($data);
    }

    public function __construct($data)
    {
        $this->pageName = $data['page_name'];
        $this->title = $data['title'];
        $this->summary = $data['summary'];
        $this->action = $data['action'];
        $this->sha = $data['sha'];
        $this->htmlUrl = $data['html_url'];
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Action value can be one of ['created', 'edited'].
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }
}
