<?php



namespace LoveOSS\Github\Entity;

use LoveOSS\Github\Exception\UserAgentNotFoundException;
use LoveOSS\Github\Exception\AllowUrlFileOpenException;

class PullRequest
{
    private $url;
    private $id;
    private $htmlUrl;
    private $diffUrl;
    private $issueUrl;
    private $number;
    private $state;
    private $isLocked;
    private $title;

    /**
     * @var User
     */
    private $user;
    private $body;
    private $createdAt;
    private $updatedAt;
    private $closedAt;
    private $mergedAt;
    private $mergeCommitSha;

    /**
     * @var User|null
     */
    private $assignee;
    private $milestone;
    private $commitsUrl;
    private $reviewCommentUrl;
    private $reviewCommentsUrl;
    private $statusesUrl;
    private $isMerged;
    private $isMergeable;
    private $mergeableState;

    /**
     * @var User|null
     */
    private $mergedBy;
    private $commentsCount;
    private $reviewCommentsCount;
    private $commitsCount;
    private $additions;
    private $deletions;
    private $changedFiles;
    private $commitSha;
    private $base;
    private $head;

    public static function createFromData(array $data)
    {
        return new static($data);
    }

    final public function __construct($data)
    {
        $this->url = $data['url'];
        $this->id = $data['id'];
        $this->htmlUrl = $data['html_url'];
        $diffUrl = isset($data['diff_url']) ? $data['diff_url'] : null;
        $diffUrlFromPR = isset($data['pull_request']['diff_url']) ? $data['pull_request']['diff_url'] : null;
        $this->diffUrl = !is_null($diffUrl) ? $diffUrl : $diffUrlFromPR;
        $this->issueUrl = isset($data['issue_url']) ? $data['issue_url'] : null;
        $this->number = $data['number'];
        $this->state = $data['state'];
        $this->isLocked = $data['locked'];
        $this->title = $data['title'];
        $this->user = User::createFromData($data['user']);
        $this->body = $data['body'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = isset($data['updated_at']) ? $data['updated_at'] : null;
        $this->closedAt = $data['closed_at'];
        $this->mergedAt = isset($data['merged_at']) ? $data['merged_at'] : null;
        $this->mergeCommitSha = isset($data['merge_commit_sha']) ? $data['merge_commit_sha'] : null;
        $this->assignee = isset($data['assignee']) ? User::createFromData($data['assignee']) : null;
        $this->milestone = $data['milestone'];
        $this->commitsUrl = isset($data['commits_url']) ? $data['commits_url'] : null;
        $this->reviewCommentUrl = isset($data['review_comment_url']) ? $data['review_comment_url'] : null;
        $this->reviewCommentsUrl = isset($data['review_comments_url']) ? $data['review_comments_url'] : null;
        $this->statusesUrl = isset($data['statuses_url']) ? $data['statuses_url'] : null;
        $this->isLocked = isset($data['locked']) ? $data['locked'] : null;
        $this->isMerged = isset($data['merged']) ? $data['merged'] : null;
        $this->isMergeable = isset($data['mergeable']) ? $data['mergeable'] : null;
        $this->mergeableState = isset($data['mergeable_state']) ? $data['mergeable_state'] : false;
        $this->mergedBy = isset($data['merged_by']) ? User::createFromData($data['merged_by']) : null;
        $this->commentsCount = isset($data['comments']) ? $data['comments'] : null;
        $this->reviewCommentsCount = isset($data['review_comments']) ? $data['review_comments'] : null;
        $this->commitSha = isset($data['head']['sha']) ? $data['head']['sha'] : null;
        $this->base = isset($data['base']) ? $data['base'] : null;
        $this->head = isset($data['head']) ? $data['head'] : null;
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
     * Sets the value of url.
     *
     * @param mixed $url the url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
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
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Sets the value of htmlUrl.
     *
     * @param mixed $htmlUrl the html url
     *
     * @return self
     */
    public function setHtmlUrl($htmlUrl)
    {
        $this->htmlUrl = $htmlUrl;

        return $this;
    }

    /**
     * Gets the value of diffUrl.
     *
     * @return mixed
     */
    public function getDiffUrl()
    {
        return $this->diffUrl;
    }

    /**
     * Sets the value of diffUrl.
     *
     * @param mixed $diffUrl the diff url
     *
     * @return self
     */
    public function setDiffUrl($diffUrl)
    {
        $this->diffUrl = $diffUrl;

        return $this;
    }

    /**
     * Gets the value of issueUrl.
     *
     * @return mixed
     */
    public function getIssueUrl()
    {
        return $this->issueUrl;
    }

    /**
     * Sets the value of issueUrl.
     *
     * @param mixed $issueUrl the issue url
     *
     * @return self
     */
    public function setIssueUrl($issueUrl)
    {
        $this->issueUrl = $issueUrl;

        return $this;
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
     * Sets the value of number.
     *
     * @param mixed $number the number
     *
     * @return self
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
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
     * Sets the value of state.
     *
     * @param mixed $state the state
     *
     * @return self
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Gets the value of locked.
     *
     * @return bool
     */
    public function isLocked()
    {
        return (bool) $this->isLocked;
    }

    /**
     * Sets the value of locked.
     *
     * @param mixed $locked the locked
     *
     * @return self
     */
    public function setLocked($locked)
    {
        $this->isLocked = $locked;

        return $this;
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
     * Sets the value of title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Sets the value of user.
     *
     * @param mixed $user the user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
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
     * Sets the value of body.
     *
     * @param mixed $body the body
     *
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
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
     * Sets the value of createdAt.
     *
     * @param mixed $createdAt the created at
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * Sets the value of updatedAt.
     *
     * @param mixed $updatedAt the updated at
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
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
     * Sets the value of closedAt.
     *
     * @param mixed $closedAt the closed at
     *
     * @return self
     */
    public function setClosedAt($closedAt)
    {
        $this->closedAt = $closedAt;

        return $this;
    }

    /**
     * Gets the value of mergedAt.
     *
     * @return mixed
     */
    public function getMergedAt()
    {
        return $this->mergedAt;
    }

    /**
     * Sets the value of mergedAt.
     *
     * @param mixed $mergedAt the merged at
     *
     * @return self
     */
    public function setMergedAt($mergedAt)
    {
        $this->mergedAt = $mergedAt;

        return $this;
    }

    /**
     * Gets the value of mergeCommitSha.
     *
     * @return mixed
     */
    public function getMergeCommitSha()
    {
        return $this->mergeCommitSha;
    }

    /**
     * Sets the value of mergeCommitSha.
     *
     * @param mixed $mergeCommitSha the merge commit sha
     *
     * @return self
     */
    public function setMergeCommitSha($mergeCommitSha)
    {
        $this->mergeCommitSha = $mergeCommitSha;

        return $this;
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
     * Sets the value of assignee.
     *
     * @param mixed $assignee the assignee
     *
     * @return self
     */
    public function setAssignee($assignee)
    {
        $this->assignee = $assignee;

        return $this;
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
     * Sets the value of milestone.
     *
     * @param mixed $milestone the milestone
     *
     * @return self
     */
    public function setMilestone($milestone)
    {
        $this->milestone = $milestone;

        return $this;
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
     * Sets the value of commitsUrl.
     *
     * @param mixed $commitsUrl the commits url
     *
     * @return self
     */
    public function setCommitsUrl($commitsUrl)
    {
        $this->commitsUrl = $commitsUrl;

        return $this;
    }

    /**
     * Gets the value of reviewCommentUrl.
     *
     * @return mixed
     */
    public function getReviewCommentUrl()
    {
        return $this->reviewCommentUrl;
    }

    /**
     * Sets the value of reviewCommentUrl.
     *
     * @param mixed $reviewCommentUrl the review comment url
     *
     * @return self
     */
    public function setReviewCommentUrl($reviewCommentUrl)
    {
        $this->reviewCommentUrl = $reviewCommentUrl;

        return $this;
    }

    /**
     * Gets the value of reviewCommentsUrl.
     *
     * @return mixed
     */
    public function getReviewCommentsUrl()
    {
        return $this->reviewCommentsUrl;
    }

    /**
     * Sets the value of reviewCommentsUrl.
     *
     * @param mixed $reviewCommentsUrl the review comments url
     *
     * @return self
     */
    public function setReviewCommentsUrl($reviewCommentsUrl)
    {
        $this->reviewCommentsUrl = $reviewCommentsUrl;

        return $this;
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
     * Sets the value of statusesUrl.
     *
     * @param mixed $statusesUrl the statuses url
     *
     * @return self
     */
    public function setStatusesUrl($statusesUrl)
    {
        $this->statusesUrl = $statusesUrl;

        return $this;
    }

    /**
     * Gets the value of merged.
     *
     * @return bool
     */
    public function isMerged()
    {
        return (bool) $this->isMerged;
    }

    /**
     * Sets the value of merged.
     *
     * @param mixed $merged the merged
     *
     * @return self
     */
    public function setMerged($merged)
    {
        $this->isMerged = $merged;

        return $this;
    }

    /**
     * Gets the value of mergeable.
     *
     * @return bool
     */
    public function isMergeable()
    {
        return (bool) $this->isMergeable;
    }

    /**
     * Sets the value of mergeable.
     *
     * @param mixed $mergeable the mergeable
     *
     * @return self
     */
    public function setMergeable($mergeable)
    {
        $this->isMergeable = $mergeable;

        return $this;
    }

    /**
     * Gets the value of mergeableState.
     *
     * @return mixed
     */
    public function getMergeableState()
    {
        return $this->mergeableState;
    }

    /**
     * Sets the value of mergeableState.
     *
     * @param mixed $mergeableState the mergeable state
     *
     * @return self
     */
    public function setMergeableState($mergeableState)
    {
        $this->mergeableState = $mergeableState;

        return $this;
    }

    /**
     * Gets the value of mergedBy.
     *
     * @return mixed
     */
    public function getMergedBy()
    {
        return $this->mergedBy;
    }

    /**
     * Sets the value of mergedBy.
     *
     * @param mixed $mergedBy the merged by
     *
     * @return self
     */
    public function setMergedBy($mergedBy)
    {
        $this->mergedBy = $mergedBy;

        return $this;
    }

    /**
     * Gets the count of comments.
     *
     * @return mixed
     */
    public function getCommentsCount()
    {
        return $this->commentsCount;
    }

    /**
     * Sets the count of comments.
     *
     * @param mixed $comments the comments
     *
     * @return self
     */
    public function setCommentsCount($comments)
    {
        $this->commentsCount = $comments;

        return $this;
    }

    /**
     * Gets the count of reviewComments.
     *
     * @return mixed
     */
    public function getReviewCommentsCount()
    {
        return $this->reviewCommentsCount;
    }

    /**
     * Sets the count of reviewComments.
     *
     * @param mixed $reviewComments the review comments
     *
     * @return self
     */
    public function setReviewCommentsCount($reviewComments)
    {
        $this->reviewCommentsCount = $reviewComments;

        return $this;
    }

    /**
     * Gets the count of commits.
     *
     * @return mixed
     */
    public function getCommitsCount()
    {
        return $this->commitsCount;
    }

    /**
     * Sets the value of commits.
     *
     * @param mixed $commits the commits
     *
     * @return self
     */
    public function setCommitsCount($commits)
    {
        $this->commitsCount = $commits;

        return $this;
    }

    /**
     * Gets the value of additions.
     *
     * @return mixed
     */
    public function getAdditions()
    {
        return $this->additions;
    }

    /**
     * Sets the value of additions.
     *
     * @param mixed $additions the additions
     *
     * @return self
     */
    public function setAdditions($additions)
    {
        $this->additions = $additions;

        return $this;
    }

    /**
     * Gets the value of deletions.
     *
     * @return mixed
     */
    public function getDeletions()
    {
        return $this->deletions;
    }

    /**
     * Sets the value of deletions.
     *
     * @param mixed $deletions the deletions
     *
     * @return self
     */
    public function setDeletions($deletions)
    {
        $this->deletions = $deletions;

        return $this;
    }

    /**
     * Gets the value of changedFiles.
     *
     * @return mixed
     */
    public function getChangedFiles()
    {
        return $this->changedFiles;
    }

    /**
     * Sets the value of changedFiles.
     *
     * @param mixed $changedFiles the changed files
     *
     * @return self
     */
    public function setChangedFiles($changedFiles)
    {
        $this->changedFiles = $changedFiles;

        return $this;
    }

    /**
     * Gets the value of commit.
     *
     * @return mixed
     */
    public function getCommitSha()
    {
        return $this->commitSha;
    }

    /**
     * Get the commits.
     *
     * @return Commit[]
     */
    public function getCommits()
    {
        $commits = [];
        if ('' === ini_get('user_agent')) {
            throw new UserAgentNotFoundException();
        }

        if (!ini_get('allow_url_fopen')) {
            throw new AllowUrlFileOpenException();
        }

        $jsonResponse = $this->getFileContent($this->getCommitsUrl(), ini_get('user_agent'));
        $response = json_decode($jsonResponse, true);

        foreach ($response as $commitArray) {
            $commit = Commit::createFromData($commitArray['commit'])
                ->setSha($commitArray['sha'])
            ;

            $commits[] = $commit;
        }

        return $commits;
    }

    /**
     * Some helpers.
     */
    public function isClosed()
    {
        return 'closed' === $this->state;
    }

    /*
     * Get the HEAD information.
     *
     * @return array
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Get the BASE information.
     *
     * @return array
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * A better file_get_contents
     */
    private function getFileContent($url, $userAgent)
    {
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: '. $userAgent
                ]
            ]
        ];

        $context = stream_context_create($opts);

        return file_get_contents($url, false, $context);
    }
}
