<?php



namespace LoveOSS\Github\Entity;

class Deployment
{
    private $url;
    private $id;
    private $sha;
    private $ref;
    private $task;
    private $payload;
    private $environment;
    private $description;

    /**
     * @var User
     */
    private $creator;
    private $createdAt;
    private $updatedAt;
    private $statusesUrl;
    private $repositoryUrl;

    public static function createFromData(array $data)
    {
        return new static($data);
    }

    public function __construct($data)
    {
        $this->url = $data['url'];
        $this->id = $data['id'];
        $this->sha = $data['sha'];
        $this->ref = $data['ref'];
        $this->task = $data['task'];
        $this->payload = $data['payload'];
        $this->environment = $data['environment'];
        $this->description = $data['description'];
        $this->creator = User::createFromData($data['creator']);
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
        $this->statusesUrl = $data['statuses_url'];
        $this->repositoryUrl = $data['repository_url'];
    }

    /**
     * Gets the value of url.
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the value of sha.
     *
     * @return mixed
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * Gets the value of ref.
     *
     * @return mixed
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Gets the value of task.
     *
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Gets the value of payload.
     *
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Gets the value of environment.
     *
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets the value of creator.
     *
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Gets the value of updatedAt.
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Gets the value of statusesUrl.
     *
     * @return mixed
     */
    public function getStatusesUrl()
    {
        return $this->statusesUrl;
    }

    /**
     * Gets the value of repositoryUrl.
     *
     * @return mixed
     */
    public function getRepositoryUrl()
    {
        return $this->repositoryUrl;
    }
}
