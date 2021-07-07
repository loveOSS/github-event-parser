<?php



namespace Tests\Parser;

use LoveOSS\Github\Parser\WebhookResolver;
use PHPUnit\Framework\TestCase;

class WebhookResolverTest extends TestCase
{
    /** @var $userAgent string */
    public static $userAgent;

    /** @var $resolver \LoveOSS\Github\Parser\WebhookResolver */
    private $resolver;

    /** @var $jsonDataFolder string */
    private $jsonDataFolder;

    public static function setUpBeforeClass(): void
    {
        self::$userAgent = 'MyClient/1.0.0';
    }

    public function setUp(): void
    {
        ini_set('user_agent', self::$userAgent);
        $this->resolver = new WebhookResolver();
        $this->jsonDataFolder = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'json-data'.DIRECTORY_SEPARATOR;
    }

    public function tearDown(): void
    {
        $this->resolver = null;
    }

    public function testResolveIssuesEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'issue_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\IssuesEvent", $event);

        $this->assertEquals('opened', $event->action);
        $this->assertEquals('Spelling error in the README file', $event->issue->getTitle());
        $this->assertEquals('35129377', $event->repository->getId());
    }

    public function testResolveIssueCommitEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'issue_commit_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\IssueCommentEvent", $event);

        $this->assertEquals('Spelling error in the README file', $event->issue->getTitle());
        $this->assertEquals('baxterthehacker', $event->user->getLogin());
        $this->assertEquals("You are totally right! I'll get this fixed right away.", $event->comment->getBody());
    }

    public function testResolveForkEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'fork_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\ForkEvent", $event);

        $this->assertEquals('baxterandthehackers/public-repo', $event->forkedRepository->getFullName());
        $this->assertEquals('7649605', $event->owner->getId());
        $this->assertEquals('https://api.github.com/repos/baxterthehacker/public-repo', $event->repository->getUrl());
    }

    public function testResolveDeploymentStatusEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'deployment_status_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\DeploymentStatusEvent", $event);

        $this->assertEquals('production', $event->deployment->getEnvironment());
        $this->assertEquals('public-repo', $event->repository->getName());
        $this->assertEquals('User', $event->sender->getType());
    }

    public function testResolvePullRequestEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\PullRequestEvent", $event);

        $this->assertEquals('Update the README with new information', $event->pullRequest->getTitle());
        $this->assertEquals('opened', $event->action);
        $this->assertEquals('1', $event->number);
        $this->assertEquals('baxterthehacker', $event->sender->getLogin());
        $this->assertInstanceOf('LoveOSS\Github\Entity\Repository', $event->repository);
    }

    public function testResolveStatusEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'status_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\StatusEvent", $event);

        $this->assertEquals('baxterthehacker', $event->committer->getLogin());
        $this->assertEquals('public-repo', $event->repository->getName());
        $this->assertEquals('success', $event->state);
        $this->assertEquals('9049f1265b7d61be4a8904a9a27120d2064dab3b', $event->sha);
    }

    public function testResolveReleaseEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'release_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\ReleaseEvent", $event);

        $this->assertInstanceOf("LoveOSS\Github\Entity\Release", $event->release);
        $this->assertEquals('published', $event->action);
        $this->assertEquals('https://api.github.com/repos/baxterthehacker/public-repo/releases/1261438', $event->release->getUrl());
        $this->assertEquals('https://github.com/baxterthehacker/public-repo/releases/tag/0.0.1', $event->release->getHtmlUrl());
    }

    public function testResolveWatchEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'watch_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\WatchEvent", $event);
        $this->assertInstanceOf("LoveOSS\Github\Entity\Repository", $event->repository);
        $this->assertInstanceOf("LoveOSS\Github\Entity\User", $event->user);

        $this->assertEquals('started', $event->action);
    }

    public function testResolvePullRequestReviewCommentEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'pull_request_review_comment_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\PullRequestReviewCommentEvent", $event);
        $this->assertInstanceOf("LoveOSS\Github\Entity\Repository", $event->repository);
        $this->assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);
        $this->assertInstanceOf("LoveOSS\Github\Entity\Comment", $event->comment);
    }

    public function testResolveGollumEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'gollum_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\GollumEvent", $event);
        $this->assertInstanceOf("LoveOSS\Github\Entity\Repository", $event->repository);
        $this->assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);
        $this->assertIsArray($event->pages);
        $this->assertCount(2, $event->pages);

        $this->assertInstanceOf("LoveOSS\Github\Entity\Page", current($event->pages));
        $this->assertInstanceOf("LoveOSS\Github\Entity\Page", next($event->pages));

        $this->assertEquals('Home', $event->pages[0]->getTitle());
        $this->assertEquals('Home2', $event->pages[1]->getTitle());
    }

    public function testPushEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'push_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\PushEvent", $event);
    }

    public function testResolvePullRequestEventCommitsOk()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\PullRequestEvent", $event);
        $pullRequest = $event->pullRequest;

        $this->assertInstanceOf("LoveOSS\Github\Entity\PullRequest", $pullRequest);

        $commits = $pullRequest->getCommits();
        $this->assertTrue(is_array($commits));
        $commit = $commits[0];
        $this->assertInstanceOf("LoveOSS\Github\Entity\Commit", $commit);
    }

    public function testResolvePullRequestHasIntegration()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\Entity\Integration", $event->integration);
    }

    public function testResolvePullRequestEventCommitThrowsException()
    {
        ini_set('user_agent', '');
        $this->expectException('LoveOSS\Github\Exception\UserAgentNotFoundException');

        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);
        $event->pullRequest->getCommits();
    }

    public function testResolveWithMissingRepositoryThrowsException()
    {
        $this->expectException('LoveOSS\Github\Exception\RepositoryNotFoundException');

        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'repository_not_found.json'), true);
        $this->resolver->resolve($jsonReceived);
    }

    public function testResolveWithMalformedRepositoryThrowsException()
    {
        $this->expectException('LoveOSS\Github\Exception\RepositoryNotFoundException');

        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'repository_malformed.json'), true);
        $this->resolver->resolve($jsonReceived);
    }

    public function testResolveIntegrationInstallationEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'integration_installation_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\IntegrationInstallationEvent", $event);
        $this->assertInstanceOf("LoveOSS\Github\Entity\Integration", $event->integration);
        $this->assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);

        $this->assertIsString($event->integration->getAccessTokenUrl());
        $this->assertIsString($event->integration->getRepositoriesUrl());
    }

    public function testResolveIntegrationInstallationRepositoriesEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder.'integration_installation_repositories_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        $this->assertInstanceOf("LoveOSS\Github\EventType\IntegrationInstallationRepositoriesEvent", $event);
        $this->assertInstanceOf("LoveOSS\Github\Entity\Integration", $event->integration);
        $this->assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);
        $this->assertIsString($event->repositorySelection);
        $this->assertIsArray($event->repositoryAdded);
        $this->assertIsArray($event->repositoryRemoved);

        $this->assertIsString($event->integration->getAccessTokenUrl());
        $this->assertIsString($event->integration->getRepositoriesUrl());
        $this->assertIsString($event->integration->getHtmlUrl());
    }
}
