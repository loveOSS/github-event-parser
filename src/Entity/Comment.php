<?php

namespace LoveOSS\Github\Entity;

class Comment
{
    private string $url;
    private string $htmlUrl;
    private string $id;

    private User $user;
    private string $position;
    private string $line;
    private string $path;
    private string $commitId;
    private string $createdAt;
    private string $updatedAt;
    private string $body;

    /**
     * @param array<string> $data
     */
    public static function createFromData(array $data): self
    {
        return new static($data);
    }

    /**
     * @param array<string> $data
     */
    final public function __construct($data)
    {
        $this->url = $data['url'] ?? '';
        $this->htmlUrl = $data['html_url'] ?? '';
        $this->id = $data['id'] ?? '';

        $user = is_array($data['user']) ? $data['user'] : [];

        $this->user = User::createFromData($user);
        $this->position = isset($data['position']) ? $data['position'] : '';
        $this->line = isset($data['line']) ? $data['line'] : '';
        $this->path = isset($data['path']) ? $data['path'] : '';
        $this->commitId = isset($data['commit_id']) ? $data['commit_id'] : '';
        $this->createdAt = isset($data['created_at']) ? $data['created_at'] : '';
        $this->updatedAt = isset($data['updated_at']) ? $data['updated_at'] : '';
        $this->body = isset($data['body']) ? $data['body'] : '';
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHtmlUrl(): string
    {
        return $this->htmlUrl;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getUserLogin(): string
    {
        return $this->user->getLogin();
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getLine(): string
    {
        return $this->line;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getCommitId(): string
    {
        return $this->commitId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Get an human readable description of Comment object: the comment.
     *
     * @return string the comment
     */
    public function __toString(): string
    {
        return $this->body;
    }
}
