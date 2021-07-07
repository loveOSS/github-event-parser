<?php



namespace LoveOSS\Github\Entity;

class User
{
    private $login;
    private $id;
    private $avatarUrl;
    private $gravatarId;
    private $apiUrl;
    private $htmlUrl;
    private $followersUrl;
    private $followingUrl;
    private $gistsUrl;
    private $starredUrl;
    private $subscriptionsUrl;
    private $organizationsUrl;
    private $repositoriesUrl;
    private $eventsUrl;
    private $receivedEventsUrl;
    private $type;
    private $siteAdmin;

    public static function createFromData(array $data)
    {
        if (isset($data['login'], $data['id'])) {
            return new static($data);
        }

        return $data['name'];
    }

    public function __construct($data)
    {
        $this->login = $data['login'];
        $this->id = $data['id'];
        $this->avatarUrl = $data['avatar_url'];
        $this->gravatarId = $data['gravatar_id'];
        $this->apiUrl = $data['url'];
        $this->htmlUrl = $data['html_url'];
        $this->followersUrl = $data['followers_url'];
        $this->followingUrl = $data['following_url'];
        $this->gistsUrl = $data['gists_url'];
        $this->starredUrl = $data['starred_url'];
        $this->subscriptionsUrl = $data['subscriptions_url'];
        $this->organizationsUrl = $data['organizations_url'];
        $this->repositoriesUrl = $data['repos_url'];
        $this->eventsUrl = $data['events_url'];
        $this->receivedEventsUrl = $data['received_events_url'];
        $this->type = $data['type'];
        $this->siteAdmin = $data['site_admin'];
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
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
     * Gets the value of avatarUrl.
     *
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Gets the value of gravatarId.
     *
     * @return mixed
     */
    public function getGravatarId()
    {
        return $this->gravatarId;
    }

    /**
     * Gets the value of apiUrl.
     *
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
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
     * Gets the value of followersUrl.
     *
     * @return mixed
     */
    public function getFollowersUrl()
    {
        return $this->followersUrl;
    }

    /**
     * Gets the value of followingUrl.
     *
     * @return mixed
     */
    public function getFollowingUrl()
    {
        return $this->followingUrl;
    }

    /**
     * Gets the value of gistsUrl.
     *
     * @return mixed
     */
    public function getGistsUrl()
    {
        return $this->gistsUrl;
    }

    /**
     * Gets the value of starredUrl.
     *
     * @return mixed
     */
    public function getStarredUrl()
    {
        return $this->starredUrl;
    }

    /**
     * Gets the value of organizationsUrl.
     *
     * @return mixed
     */
    public function getOrganizationsUrl()
    {
        return $this->organizationsUrl;
    }

    /**
     * Gets the value of subscriptionsUrl.
     *
     * @return mixed
     */
    public function getSubscriptionsUrl()
    {
        return $this->subscriptionsUrl;
    }

    /**
     * Gets the value of repositoriesUrl.
     *
     * @return mixed
     */
    public function getRepositoriesUrl()
    {
        return $this->repositoriesUrl;
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
     * Gets the value of receivedEventsUrl.
     *
     * @return mixed
     */
    public function getReceivedEventsUrl()
    {
        return $this->receivedEventsUrl;
    }

    /**
     * Gets the value of type.
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets the value of siteAdmin.
     *
     * @return mixed
     */
    public function getSiteAdmin()
    {
        return $this->siteAdmin;
    }
}
