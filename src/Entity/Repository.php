<?php



namespace LoveOSS\Github\Entity;

class Repository
{
    private $id;
    private $name;
    private $fullName;

    /**
     * @var User
     */
    private $owner;
    private $isPrivate;
    private $htmlUrl;
    private $description;
    private $isFork;
    private $url;
    private $forksUrl;
    private $keysUrl;
    private $collaboratorsUrl;
    private $teamsUrl;
    private $hooksUrl;
    private $issueEventsUrl;
    private $eventsUrl;
    private $assigneesUrl;
    private $branchesUrl;
    private $tagsUrl;
    private $blobsUrl;
    private $gitTagsUrl;
    private $gitRefsUrl;
    private $treesUrl;
    private $statusesUrl;
    private $languagesUrl;
    private $stargazersUrl;
    private $contributorsUrl;
    private $subscribersUrl;
    private $subscriptionUrl;
    private $commitsUrl;
    private $gitCommitsUrl;
    private $commentsUrl;
    private $issueCommentUrl;
    private $contentsUrl;
    private $compareUrl;
    private $mergesUrl;
    private $archiveUrl;
    private $downloadsUrl;
    private $issuesUrl;
    private $pullsUrl;
    private $milestonesUrl;
    private $notificationsUrl;
    private $labelsUrl;
    private $releasesUrl;
    private $createdAt;
    private $updatedAt;
    private $pushedAt;
    private $gitUrl;
    private $sshUrl;
    private $cloneUrl;
    private $svnUrl;
    private $homepage;
    private $size;
    private $stargazersCount;
    private $watchersCount;
    private $language;
    private $hasIssues;
    private $hasDownloads;
    private $hasWiki;
    private $hasPages;
    private $forksCount;
    private $mirrorUrl;
    private $openIssues;
    private $watchers;
    private $defaultBranch;
    private $isPublic;

    public static function createFromData(array $data)
    {
        return new static($data);
    }

    final public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->fullName = $data['full_name'];
        $this->owner = User::createFromData($data['owner']);
        $this->isPrivate = $data['private'];
        $this->htmlUrl = $data['html_url'];
        $this->description = $data['description'];
        $this->isFork = $data['fork'];
        $this->url = $data['url'];
        $this->forksUrl = $data['forks_url'];
        $this->keysUrl = $data['keys_url'];
        $this->collaboratorsUrl = $data['collaborators_url'];
        $this->teamsUrl = $data['teams_url'];
        $this->hooksUrl = $data['hooks_url'];
        $this->issueEventsUrl = $data['issue_events_url'];
        $this->eventsUrl = $data['events_url'];
        $this->assigneesUrl = $data['assignees_url'];
        $this->branchesUrl = $data['branches_url'];
        $this->tagsUrl = $data['tags_url'];
        $this->blobsUrl = $data['blobs_url'];
        $this->gitTagsUrl = $data['git_tags_url'];
        $this->gitRefsUrl = $data['git_refs_url'];
        $this->treesUrl = $data['trees_url'];
        $this->statusesUrl = $data['statuses_url'];
        $this->languagesUrl = $data['languages_url'];
        $this->stargazersUrl = $data['stargazers_url'];
        $this->contributorsUrl = $data['contributors_url'];
        $this->subscribersUrl = $data['subscribers_url'];
        $this->subscriptionUrl = $data['subscription_url'];
        $this->commitsUrl = $data['commits_url'];
        $this->gitCommitsUrl = $data['git_commits_url'];
        $this->commentsUrl = $data['comments_url'];
        $this->issueCommentUrl = $data['issue_comment_url'];
        $this->contentsUrl = $data['contents_url'];
        $this->compareUrl = $data['compare_url'];
        $this->mergesUrl = $data['merges_url'];
        $this->archiveUrl = $data['archive_url'];
        $this->downloadsUrl = $data['downloads_url'];
        $this->issuesUrl = $data['issues_url'];
        $this->pullsUrl = $data['pulls_url'];
        $this->milestonesUrl = $data['milestones_url'];
        $this->notificationsUrl = $data['notifications_url'];
        $this->labelsUrl = $data['labels_url'];
        $this->releasesUrl = $data['releases_url'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
        $this->pushedAt = $data['pushed_at'];
        $this->gitUrl = $data['git_url'];
        $this->sshUrl = $data['ssh_url'];
        $this->cloneUrl = $data['clone_url'];
        $this->svnUrl = $data['svn_url'];
        $this->homepage = $data['homepage'];
        $this->size = $data['size'];
        $this->stargazersCount = $data['stargazers_count'];
        $this->watchersCount = $data['watchers_count'];
        $this->language = $data['language'];
        $this->hasIssues = $data['has_issues'];
        $this->hasDownloads = $data['has_downloads'];
        $this->hasWiki = $data['has_wiki'];
        $this->hasPages = $data['has_pages'];
        $this->forksCount = $data['forks_count'];
        $this->mirrorUrl = $data['mirror_url'];
        $this->openIssues = $data['open_issues'];
        $this->watchers = $data['watchers'];
        $this->defaultBranch = $data['default_branch'];
        $this->isPublic = isset($data['public']) ?: null;
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
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the value of fullName.
     *
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Gets the value of owner.
     *
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Gets the value of isPrivate.
     *
     * @return mixed
     */
    public function isPrivate()
    {
        return $this->isPrivate;
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
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets the value of isFork.
     *
     * @return mixed
     */
    public function isFork()
    {
        return $this->isFork;
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
     * Gets the value of forksUrl.
     *
     * @return mixed
     */
    public function getForksUrl()
    {
        return $this->forksUrl;
    }

    /**
     * Gets the value of keysUrl.
     *
     * @return mixed
     */
    public function getKeysUrl()
    {
        return $this->keysUrl;
    }

    /**
     * Gets the value of collaboratorsUrl.
     *
     * @return mixed
     */
    public function getCollaboratorsUrl()
    {
        return $this->collaboratorsUrl;
    }

    /**
     * Gets the value of teamsUrl.
     *
     * @return mixed
     */
    public function getTeamsUrl()
    {
        return $this->teamsUrl;
    }

    /**
     * Gets the value of hooksUrl.
     *
     * @return mixed
     */
    public function getHooksUrl()
    {
        return $this->hooksUrl;
    }

    /**
     * Gets the value of issueEventsUrl.
     *
     * @return mixed
     */
    public function getIssueEventsUrl()
    {
        return $this->issueEventsUrl;
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
     * Gets the value of assigneesUrl.
     *
     * @return mixed
     */
    public function getAssigneesUrl()
    {
        return $this->assigneesUrl;
    }

    /**
     * Gets the value of branchesUrl.
     *
     * @return mixed
     */
    public function getBranchesUrl()
    {
        return $this->branchesUrl;
    }

    /**
     * Gets the value of tagsUrl.
     *
     * @return mixed
     */
    public function getTagsUrl()
    {
        return $this->tagsUrl;
    }

    /**
     * Gets the value of blobsUrl.
     *
     * @return mixed
     */
    public function getBlobsUrl()
    {
        return $this->blobsUrl;
    }

    /**
     * Gets the value of gitTagsUrl.
     *
     * @return mixed
     */
    public function getGitTagsUrl()
    {
        return $this->gitTagsUrl;
    }

    /**
     * Gets the value of gitRefsUrl.
     *
     * @return mixed
     */
    public function getGitRefsUrl()
    {
        return $this->gitRefsUrl;
    }

    /**
     * Gets the value of treesUrl.
     *
     * @return mixed
     */
    public function getTreesUrl()
    {
        return $this->treesUrl;
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
     * Gets the value of languagesUrl.
     *
     * @return mixed
     */
    public function getLanguagesUrl()
    {
        return $this->languagesUrl;
    }

    /**
     * Gets the value of stargazersUrl.
     *
     * @return mixed
     */
    public function getStargazersUrl()
    {
        return $this->stargazersUrl;
    }

    /**
     * Gets the value of contributorsUrl.
     *
     * @return mixed
     */
    public function getContributorsUrl()
    {
        return $this->contributorsUrl;
    }

    /**
     * Gets the value of subscribersUrl.
     *
     * @return mixed
     */
    public function getSubscribersUrl()
    {
        return $this->subscribersUrl;
    }

    /**
     * Gets the value of subscriptionUrl.
     *
     * @return mixed
     */
    public function getSubscriptionUrl()
    {
        return $this->subscriptionUrl;
    }

    /**
     * Gets the value of commitsUrl.
     *
     * @return mixed
     */
    public function getCommitsUrl()
    {
        return $this->commitsUrl;
    }

    /**
     * Gets the value of gitCommitsUrl.
     *
     * @return mixed
     */
    public function getGitCommitsUrl()
    {
        return $this->gitCommitsUrl;
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
     * Gets the value of issueCommentUrl.
     *
     * @return mixed
     */
    public function getIssueCommentUrl()
    {
        return $this->issueCommentUrl;
    }

    /**
     * Gets the value of contentsUrl.
     *
     * @return mixed
     */
    public function getContentsUrl()
    {
        return $this->contentsUrl;
    }

    /**
     * Gets the value of compareUrl.
     *
     * @return mixed
     */
    public function getCompareUrl()
    {
        return $this->compareUrl;
    }

    /**
     * Gets the value of mergesUrl.
     *
     * @return mixed
     */
    public function getMergesUrl()
    {
        return $this->mergesUrl;
    }

    /**
     * Gets the value of archiveUrl.
     *
     * @return mixed
     */
    public function getArchiveUrl()
    {
        return $this->archiveUrl;
    }

    /**
     * Gets the value of downloadsUrl.
     *
     * @return mixed
     */
    public function getDownloadsUrl()
    {
        return $this->downloadsUrl;
    }

    /**
     * Gets the value of issuesUrl.
     *
     * @return mixed
     */
    public function getIssuesUrl()
    {
        return $this->issuesUrl;
    }

    /**
     * Gets the value of pullsUrl.
     *
     * @return mixed
     */
    public function getPullsUrl()
    {
        return $this->pullsUrl;
    }

    /**
     * Gets the value of milestonesUrl.
     *
     * @return mixed
     */
    public function getMilestonesUrl()
    {
        return $this->milestonesUrl;
    }

    /**
     * Gets the value of notificationsUrl.
     *
     * @return mixed
     */
    public function getNotificationsUrl()
    {
        return $this->notificationsUrl;
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
     * Gets the value of releasesUrl.
     *
     * @return mixed
     */
    public function getReleasesUrl()
    {
        return $this->releasesUrl;
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
     * Gets the value of pushedAt.
     *
     * @return mixed
     */
    public function getPushedAt()
    {
        return $this->pushedAt;
    }

    /**
     * Gets the value of gitUrl.
     *
     * @return mixed
     */
    public function getGitUrl()
    {
        return $this->gitUrl;
    }

    /**
     * Gets the value of sshUrl.
     *
     * @return mixed
     */
    public function getSshUrl()
    {
        return $this->sshUrl;
    }

    /**
     * Gets the value of cloneUrl.
     *
     * @return mixed
     */
    public function getCloneUrl()
    {
        return $this->cloneUrl;
    }

    /**
     * Gets the value of svnUrl.
     *
     * @return mixed
     */
    public function getSvnUrl()
    {
        return $this->svnUrl;
    }

    /**
     * Gets the value of homepage.
     *
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Gets the value of size.
     *
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Gets the value of stargazersCount.
     *
     * @return mixed
     */
    public function getStargazersCount()
    {
        return $this->stargazersCount;
    }

    /**
     * Gets the value of watchersCount.
     *
     * @return mixed
     */
    public function getWatchersCount()
    {
        return $this->watchersCount;
    }

    /**
     * Gets the value of language.
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Gets the value of hasIssues.
     *
     * @return mixed
     */
    public function getHasIssues()
    {
        return $this->hasIssues;
    }

    /**
     * Gets the value of hasDownloads.
     *
     * @return mixed
     */
    public function getHasDownloads()
    {
        return $this->hasDownloads;
    }

    /**
     * Gets the value of hasWiki.
     *
     * @return mixed
     */
    public function getHasWiki()
    {
        return $this->hasWiki;
    }

    /**
     * Gets the value of hasPages.
     *
     * @return mixed
     */
    public function getHasPages()
    {
        return $this->hasPages;
    }

    /**
     * Gets the value of forksCount.
     *
     * @return mixed
     */
    public function getForksCount()
    {
        return $this->forksCount;
    }

    /**
     * Gets the value of mirrorUrl.
     *
     * @return mixed
     */
    public function getMirrorUrl()
    {
        return $this->mirrorUrl;
    }

    /**
     * Gets the value of openIssues.
     *
     * @return mixed
     */
    public function getOpenIssues()
    {
        return $this->openIssues;
    }

    /**
     * Gets the value of watchers.
     *
     * @return mixed
     */
    public function getWatchers()
    {
        return $this->watchers;
    }

    /**
     * Gets the value of defaultBranch.
     *
     * @return mixed
     */
    public function getDefaultBranch()
    {
        return $this->defaultBranch;
    }

    /**
     * Gets the value of isPublic.
     *
     * @return mixed
     */
    public function isPublic()
    {
        return $this->isPublic;
    }
}
