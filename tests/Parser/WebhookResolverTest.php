<?php

namespace Tests\Parser;

use LoveOSS\Github\Parser\WebhookResolver;
use PHPUnit\Framework\TestCase;

class WebhookResolverTest extends TestCase
{
    /** @var string */
    public static $userAgent;

    /** @var \LoveOSS\Github\Parser\WebhookResolver */
    private $resolver;

    /** @var string */
    private $jsonDataFolder;

    public static function setUpBeforeClass(): void
    {
        self::$userAgent = 'MyClient/1.0.0';
    }

    public function setUp(): void
    {
        ini_set('user_agent', self::$userAgent);
        $this->resolver = new WebhookResolver();
        $this->jsonDataFolder = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'json-data' . DIRECTORY_SEPARATOR;
    }

    public function tearDown(): void
    {
        $this->resolver = null;
    }

    public function testResolveIssuesEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'issue_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\IssuesEvent", $event);

        self::assertEquals('opened', $event->action);
        self::assertEquals('Spelling error in the README file', $event->issue->getTitle());
        self::assertEquals('35129377', $event->repository->getId());
    }

    public function testResolveIssueCommitEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'issue_commit_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\IssueCommentEvent", $event);

        self::assertEquals('Spelling error in the README file', $event->issue->getTitle());
        self::assertEquals('baxterthehacker', $event->user->getLogin());
        self::assertEquals("You are totally right! I'll get this fixed right away.", $event->comment->getBody());
    }

    public function testResolveForkEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'fork_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\ForkEvent", $event);

        self::assertEquals('baxterandthehackers/public-repo', $event->forkedRepository->getFullName());
        self::assertEquals('7649605', $event->owner->getId());
        self::assertEquals('https://api.github.com/repos/baxterthehacker/public-repo', $event->repository->getUrl());
    }

    public function testResolveDeploymentStatusEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'deployment_status_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\DeploymentStatusEvent", $event);

        self::assertEquals('production', $event->deployment->getEnvironment());
        self::assertEquals('public-repo', $event->repository->getName());
        self::assertEquals('User', $event->sender->getType());
    }

    public function testResolvePullRequestEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\PullRequestEvent", $event);

        self::assertEquals('Update the README with new information', $event->pullRequest->getTitle());
        self::assertEquals('opened', $event->action);
        self::assertEquals('1', $event->number);
        self::assertEquals('baxterthehacker', $event->sender->getLogin());
        self::assertInstanceOf('LoveOSS\Github\Entity\Repository', $event->repository);
    }

    public function testResolveStatusEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'status_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\StatusEvent", $event);

        self::assertEquals('baxterthehacker', $event->committer->getLogin());
        self::assertEquals('public-repo', $event->repository->getName());
        self::assertEquals('success', $event->state);
        self::assertEquals('9049f1265b7d61be4a8904a9a27120d2064dab3b', $event->sha);
    }

    public function testResolveReleaseEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'release_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\ReleaseEvent", $event);

        self::assertInstanceOf("LoveOSS\Github\Entity\Release", $event->release);
        self::assertEquals('published', $event->action);
        self::assertEquals('https://api.github.com/repos/baxterthehacker/public-repo/releases/1261438', $event->release->getUrl());
        self::assertEquals('https://github.com/baxterthehacker/public-repo/releases/tag/0.0.1', $event->release->getHtmlUrl());
    }

    public function testResolveWatchEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'watch_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\WatchEvent", $event);
        self::assertInstanceOf("LoveOSS\Github\Entity\Repository", $event->repository);
        self::assertInstanceOf("LoveOSS\Github\Entity\User", $event->user);

        self::assertEquals('started', $event->action);
    }

    public function testResolvePullRequestReviewCommentEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'pull_request_review_comment_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\PullRequestReviewCommentEvent", $event);
        self::assertInstanceOf("LoveOSS\Github\Entity\Repository", $event->repository);
        self::assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);
        self::assertInstanceOf("LoveOSS\Github\Entity\Comment", $event->comment);
    }

    public function testResolveGollumEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'gollum_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\GollumEvent", $event);
        self::assertInstanceOf("LoveOSS\Github\Entity\Repository", $event->repository);
        self::assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);
        self::assertIsArray($event->pages);
        self::assertCount(2, $event->pages);

        self::assertInstanceOf("LoveOSS\Github\Entity\Page", current($event->pages));
        self::assertInstanceOf("LoveOSS\Github\Entity\Page", next($event->pages));

        self::assertEquals('Home', $event->pages[0]->getTitle());
        self::assertEquals('Home2', $event->pages[1]->getTitle());
    }

    public function testPushEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'push_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\PushEvent", $event);
    }

    public function testResolvePullRequestEventCommitsOk()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\PullRequestEvent", $event);
        $pullRequest = $event->pullRequest;

        self::assertInstanceOf("LoveOSS\Github\Entity\PullRequest", $pullRequest);

        $commits = $pullRequest->getCommits();
        self::assertTrue(is_array($commits));
        $commit = $commits[0];
        self::assertInstanceOf("LoveOSS\Github\Entity\Commit", $commit);
    }

    public function testResolvePullRequestHasIntegration()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\Entity\Integration", $event->integration);
    }

    public function testResolvePullRequestEventCommitThrowsException()
    {
        ini_set('user_agent', '');
        $this->expectException('LoveOSS\Github\Exception\UserAgentNotFoundException');

        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'pull_request_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);
        $event->pullRequest->getCommits();
    }

    public function testResolveWithMissingRepositoryThrowsException()
    {
        $this->expectException('LoveOSS\Github\Exception\RepositoryNotFoundException');

        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'repository_not_found.json'), true);
        $this->resolver->resolve($jsonReceived);
    }

    public function testResolveWithMalformedRepositoryThrowsException()
    {
        $this->expectException('LoveOSS\Github\Exception\RepositoryNotFoundException');

        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'repository_malformed.json'), true);
        $this->resolver->resolve($jsonReceived);
    }

    public function testResolveIntegrationInstallationEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'integration_installation_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\IntegrationInstallationEvent", $event);
        self::assertInstanceOf("LoveOSS\Github\Entity\Integration", $event->integration);
        self::assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);

        self::assertIsString($event->integration->getAccessTokenUrl());
        self::assertIsString($event->integration->getRepositoriesUrl());
    }

    public function testResolveIntegrationInstallationRepositoriesEvent()
    {
        $jsonReceived = json_decode(file_get_contents($this->jsonDataFolder . 'integration_installation_repositories_event.json'), true);
        $event = $this->resolver->resolve($jsonReceived);

        self::assertInstanceOf("LoveOSS\Github\EventType\IntegrationInstallationRepositoriesEvent", $event);
        self::assertInstanceOf("LoveOSS\Github\Entity\Integration", $event->integration);
        self::assertInstanceOf("LoveOSS\Github\Entity\User", $event->sender);
        self::assertIsString($event->repositorySelection);
        self::assertIsArray($event->repositoryAdded);
        self::assertIsArray($event->repositoryRemoved);

        self::assertIsString($event->integration->getAccessTokenUrl());
        self::assertIsString($event->integration->getRepositoriesUrl());
        self::assertIsString($event->integration->getHtmlUrl());
    }
}
