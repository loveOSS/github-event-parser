Github event parser library
============================


[![SensioLabsInsight](https://insight.symfony.com/projects/4bb32121-6a01-4b8c-9044-8a77e52dfa2c/mini.png)](https://symfony.sensiolabs.com/projects/4bb32121-6a01-4b8c-9044-8a77e52dfa2c) [![PHPStan](https://img.shields.io/badge/PHPStan-Level%205-brightgreen.svg?style=flat&logo=php)](https://shields.io/#/)


> This library is a reupload of a library created by [Mickaël Andrieu](https://github.com/mickaelandrieu) in 2016 for the Lp Digital web agency, Paris, France.
  We have obtained the authorization from the former creator to change the licence from GNU-GPL v2 to MIT.
  PHP Developers : consider using love-oss/github-event-parser as a direct replacement of lp-digital/github-event-parser.

Github Event Parser is a naive PHP library aimed to provide readable representations of json responses from [Github Events Api v3](https://developer.github.com/v3/activity/events/types/).

Thanks to the Github webhooks, any administrator of a repository can access and listen theses events returned into json responses.

The only aim of this library is to parse theses responses, and create simple POPO (Plain Old PHP Object) easy to manipulate, extends or even persist in a database.

A lot of usages are available since you can listen all events:
* make statistics on your repositories
* do some tasks after a successful deployment
* send a "thanks" email for each validated contribution
* and so on ...

## Installation

```bash
$ composer require "love-oss/github-event-parser"
```

## PHP requirements

The library may access to GitHub API to retrieve additional information.
Your PHP configuration may have `allow_url_fopen` and a valid `user_agent` enabled, or
some informations won't be retrieved.

You can use ``InvalidPhpConfigurationException`` to catch the exception:

```php
<?php

use LoveOSS\Github\Exception\InvalidPhpConfigurationException;

try {
    $commits = $pullRequest->getCommits(); // use the GitHub API when called.
} catch(InvalidPhpConfigurationException $exception) {
    // ...
}
```

## How to resolve a json response from Github ?

Once your webhook is set up, you should receive POST responses from github each time an event is dispatched by the platform.

For instance, let's consider you have a simple `github-hook.php` file and have installed your dependency through composer:
```php
<?php
include_once('./vendor/autoload.php');
use LoveOSS\Github\Parser\WebhookResolver;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $decodedJson = json_decode(file_get_contents('php://input'), true);
     $resolver    = new WebhookResolver();
     $event       = $resolver->resolve($decodedJson); // ex: an instance of `IssueCommentEvent`
     echo($event::name()); // IssueCommentEvent

     /* ... do your own business */
}
```

## EventTypes

> Note that this library is not complete, so only few events are available for now. But, it's realy easy to implement the missing. If you need them, please make a pull request!

### IssueCommentEvent

> Dispatched when someone comment an issue

You can retrieve the issue, the user and the related comment from this event.

```php
<?php
$issueCommentEvent->issue;    // instance of LoveOSS/Entity/Issue
$issueCommentEvent->user;     // instance of LoveOSS/Entity/User
$issueCommentEvent->comment;  // instance of LoveOSS/Entity/Comment
```

### IssuesEvent

> Dispatched when an issue is assigned, unassigned, labeled, unlabeled, opened, closed, or reopened.

You can retrieve the action, the repository and the sender from this event. When available, you can also get assignee and label.

```php
<?php
$issuesEvent->action;      // Can be one of "assigned", "unassigned", "labeled", "unlabeled", "opened", "closed", or "reopened".
$issuesEvent->assignee;    // optional: the assignee of the issue(LoveOSS/Entity/User)
$issuesEvent->issue;       // instance of LoveOSS/Entity/Issue
$issuesEvent->label;       // optional: the label of the issue(LoveOSS/Entity/Label)
$issuesEvent->repository;  // instance of LoveOSS/Entity/Repository
$issuesEvent->sender;      // instance of LoveOSS/Entity/User
```

### ForkEvent

> Dispatched when someone fork the repository

You can retrieve the forked repository, the owner, the new repository and the "forker".

```php
<?php
$forkEvent->forkedRepository;  // instance of LoveOSS/Entity/Repository
$forkEvent->owner;             // instance of LoveOSS/Entity/User
$forkEvent->repository;        // instance of LoveOSS/Entity/Repository
$forkEvent->forker;            // instance of LoveOSS/Entity/User
```

### DeploymentStatusEvent

> Dispatched when a deployement's status changes

You can retrieve the deployment, the sender and the related repository.

```php
<?php
$deploymentStatusEvent->deployment;   // instance of LoveOSS/Entity/Deployment
$deploymentStatusEvent->sender;       // instance of LoveOSS/Entity/User
$deploymentStatusEvent->repository;   // instance of LoveOSS/Entity/Repository
```

### PullRequestEvent

> Dispatched when a pull request is assigned, unassigned, labeled, unlabeled, opened, closed, reopened, or synchronized.

```php
$pullRequestEvent->pullRequest;   // instance of LoveOSS/Entity/PullRequest
$pullRequest->action;
/**
 * Can be one of “assigned”, “unassigned”, “labeled”, “unlabeled”, “opened”, “closed”, or “reopened”, or “synchronize”.
 * If the action is “closed” and the merged key is false, the pull request was closed with unmerged commits.
 * If the action is “closed” and the merged key is true, the pull request was merged.
 */
$pullRequest->number;             // the pull request number
$pullRequest->repository;         // instance of LoveOSS/Entity/Repository
```

### PushEvent

> Dispatched when a repository branch is pushed to. In addition to branch pushes, webhook push events are also triggered when repository tags are pushed.

```php
$pushEvent->ref       // the full Git ref that was pushed ex: refs/heads/master
$pushEvent->head      // the SHA of the most recent commit on ref after the push
$pushEvent->before    // the SHA of the most recent commit on ref before the push
$pushEvent->size      // the number of commits in the push
$pushEvent->commits   // an array of objects that describe the pushed commits 
```

### StatusEvent

> Dispatched when the status of a Git commit changes.
  Events of this type are not visible in timelines, they are only used to trigger hooks.

You can retrieve the sha, the status, the committer and the related repository. More others
informations are available.

```php
<?php
$statusEvent->sha;           // something like "9049f1265b7d61be4a8904a9a27120d2064dab3b"
$statusEvent->status;        // Can be one of "success", "failure" or "error".
$statusEvent->commiter;      // instance of LoveOSS/Entity/User
$statusEvent->repository;    // instance of LoveOSS/Entity/Repository
```

### WatchEvent

> The WatchEvent is related to starring a repository, not watching. See this [API blog post](https://developer.github.com/changes/2012-09-05-watcher-api/) for an explanation.
  The event’s actor is the user who starred a repository, and the event’s repository is the repository that was starred.

```php
<?php
$watchEvent->action;        // "started"
$watchEvent->user           // instance of LoveOSS\Entity\User
$watchEvent->repository     // instance of LoveOSS\Entity\Repository
```

### PullRequestReviewCommentEvent

> Dispatched when a comment is created on a portion of the unified diff of a pull request.

```php
<?php
$pullRequestReviewCommentEvent->action          // "created"
$pullRequestReviewCommentEvent->comment         // instance of LoveOSS\Entity\Comment
$pullRequestReviewCommentEvent->pullRequest     // instance of LoveOSS\Entity\PullRequest
$pullRequestReviewCommentEvent->repository      // instance of LoveOSS\Entity\Repository
$pullRequestReviewCommentEvent->sender          // instance of LoveOSS\Entity\User
```

### GollumEvent

> Dispatched when a Wiki page is created or updated.

```php
<?php
$gollumEvent->pages          // an array of LoveOSS\Entity\Page objects
$gollumEvent->repository     // instance of LoveOSS\Entity\Repository
$gollumEvent->sender         // instance of LoveOSS\Entity\User
```

## Entities

Each object from Github API have his PHP class.
* Comment
* Commit (and CommitUser)
* Deployment
* Issue
* Label
* Page (*Wiki*)
* PullRequest
* Release
* Repository
* User

## Roadmap

* Improve and monitor the quality of this library
* Add the missing missing events
* Add doctrine mapping file for doctrine/dbal

## How to contribute ?

**All features are tested, and all contributions need to be tested in order to be accepted.**

Features from roadmap and bug fixes are prioritized. Fork the repository, create a feature branch and then launch the testsuite:

```bash
$ ./vendor/bin/phpunit
```

Thank you for help, let us know if you use this library ;)
