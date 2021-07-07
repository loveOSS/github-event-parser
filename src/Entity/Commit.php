<?php

namespace LoveOSS\Github\Entity;

/**
 * Partial representation of Commit GitHub API.
 *
 * @doc https://developer.github.com/v3/git/commits/
 */
class Commit
{
    private $sha;
    private $url;

    /**
     * @var CommitUser
     */
    private $author;

    /**
     * @var CommitUser
     */
    private $committer;
    private $message;
    private $tree;

    public static function createFromData(array $data)
    {
        return new static($data);
    }

    final public function __construct($data)
    {
        $this->url = $data['url'];
        $this->author = CommitUser::createFromData($data['author']);
        $this->committer = CommitUser::createFromData($data['committer']);
        $this->message = $data['message'];
        $this->tree = $data['tree'];
    }

    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    public function getSha()
    {
        return $this->sha;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getCommitter()
    {
        return $this->committer;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getTree()
    {
        return $this->tree;
    }
}
