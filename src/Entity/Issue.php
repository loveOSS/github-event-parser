<?php

namespace LoveOSS\Github\Entity;

class Issue
{
    private $url;
    private $labelsUrl;
    private $commentsUrl;
    private $eventsUrl;
    private $htmlUrl;
    private $id;
    private $number;
    private $title;

    private \LoveOSS\Github\Entity\User $user;
    private array $labels;
    private $state;
    private $isLocked;

    private ?\LoveOSS\Github\Entity\User $assignee = null;
    private ?bool $milestone = null;
    private $commentsCount;
    private $createdAt;
    private $updatedAt;
    private $closedAt;
    private $body;

    public static function createFromData(array $data)
    {
        return new static($data);
    }

    final public function __construct($data)
    {
        $this->url = $data['url'];
        $this->labelsUrl = $data['labels_url'];
        $this->commentsUrl = $data['comments_url'];
        $this->eventsUrl = $data['events_url'];
        $this->htmlUrl = $data['html_url'];
        $this->id = $data['id'];
        $this->number = $data['number'];
        $this->title = $data['title'];
        $this->user = User::createFromData($data['user']);
        $this->labels = $this->buildLabels($data['labels']);
        $this->state = $data['state'];
        $this->isLocked = $data['locked'];
        $this->assignee = isset($data['assignee']) ? User::createFromData($data['assignee']) : null;
        $this->milestone = isset($data['milestone']) ?: null;
        $this->commentsCount = $data['comments'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
        $this->closedAt = $data['closed_at'];
        $this->body = $data['body'];
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
     * Gets the value of labelsUrl.
     *
     * @return mixed
     */
    public function getLabelsUrl()
    {
        return $this->labelsUrl;
    }

    /**
     * Gets the value of commentsUrl.
     *
     * @return mixed
     */
    public function getCommentsUrl()
    {
        return $this->commentsUrl;
    }

    /**
     * Gets the value of eventsUrl.
     *
     * @return mixed
     */
    public function getEventsUrl()
    {
        return $this->eventsUrl;
    }

    /**
     * Gets the value of htmlUrl.
     *
     * @return mixed
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
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
     * Gets the value of number.
     *
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Gets the value of title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets the value of user.
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Gets the value of labels.
     *
     * @return mixed
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * Gets the value of state.
     *
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Gets the value of isLocked.
     *
     * @return mixed
     */
    public function isLocked()
    {
        return $this->isLocked;
    }

    /**
     * Gets the value of assignee.
     *
     * @return mixed
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * Gets the value of milestone.
     *
     * @return mixed
     */
    public function getMilestone()
    {
        return $this->milestone;
    }

    /**
     * Gets the value of commentsCount.
     *
     * @return mixed
     */
    public function getCommentsCount()
    {
        return $this->commentsCount;
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
     * Gets the value of closedAt.
     *
     * @return mixed
     */
    public function getClosedAt()
    {
        return $this->closedAt;
    }

    /**
     * Gets the value of body.
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the Label collection from an array.
     *
     * @param array $labels an array of labels
     *
     * @return Label[] the collection of labels
     */
    private function buildLabels($labels)
    {
        $collection = [];
        foreach ($labels as $label) {
            $collection[] = Label::createFromData($label);
        }

        return $collection;
    }
}
