<?php



namespace LoveOSS\Github\Entity;

class Integration
{
    /**
     * @var int
     */
    private $installationId;

    /**
     * @var User
     */
    private $account;

    /**
     * @var string
     */
    private $accessTokenUrl;

    /**
     * @var string
     */
    private $repositoriesUrl;

    /**
     * @var string
     */
    private $htmlUrl;

    /**
     * @param array $data
     *
     * @return self
     */
    public static function createFromData(array $data)
    {
        return new static($data);
    }

    final public function __construct(array $data)
    {
        $this->installationId = $data['id'];
        $this->account = isset($data['account']) ? User::createFromData($data['account']) : null;
        $this->accessTokenUrl = isset($data['access_tokens_url']) ? $data['access_tokens_url'] : null;
        $this->repositoriesUrl = isset($data['repositories_url']) ? $data['repositories_url'] : null;
        $this->htmlUrl = isset($data['html_url']) ? $data['html_url'] : null;
    }

    /**
     * @return int
     */
    public function getInstallationId()
    {
        return $this->installationId;
    }

    /**
     * @return User
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getAccessTokenUrl()
    {
        return $this->accessTokenUrl;
    }

    /**
     * @return string
     */
    public function getRepositoriesUrl()
    {
        return $this->repositoriesUrl;
    }

    /**
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }
}
