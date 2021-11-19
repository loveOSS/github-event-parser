<?php

namespace LoveOSS\Github\Parser;

use LoveOSS\Github\EventType\GithubEventInterface;
use LoveOSS\Github\Exception\EventNotFoundException;

class WebhookResolver
{
    public function resolve(array $data): GithubEventInterface
    {
        foreach ($this->eventsType() as $eventType) {
            if ($eventType['class']::isValid($data)) {
                return (new $eventType['class']())->createFromData($data);
            }
        }

        throw new EventNotFoundException();
    }

    public function eventsType(): array
    {
        $classes = [
            'LoveOSS\Github\EventType\IssuesEvent',
            'LoveOSS\Github\EventType\IssueCommentEvent',
            'LoveOSS\Github\EventType\ForkEvent',
            'LoveOSS\Github\EventType\DeploymentStatusEvent',
            'LoveOSS\Github\EventType\GollumEvent',
            'LoveOSS\Github\EventType\IntegrationInstallationEvent',
            'LoveOSS\Github\EventType\IntegrationInstallationRepositoriesEvent',
            'LoveOSS\Github\EventType\PullRequestEvent',
            'LoveOSS\Github\EventType\PullRequestReviewCommentEvent',
            'LoveOSS\Github\EventType\PushEvent',
            'LoveOSS\Github\EventType\ReleaseEvent',
            'LoveOSS\Github\EventType\StatusEvent',
            'LoveOSS\Github\EventType\WatchEvent',
        ];

        $eventTypes = [];

        foreach ($classes as $className) {
            $name = $className::name();
            $fields = $className::fields();

            $eventTypes[$name] = ['class' => $className, 'priority' => count($fields)];
        }

        usort($eventTypes, function ($a, $b) {
            if ($a['priority'] === $b['priority']) {
                return 0;
            }

            return ($a['priority'] < $b['priority']) ? 1 : -1;
        });

        return $eventTypes;
    }
}
