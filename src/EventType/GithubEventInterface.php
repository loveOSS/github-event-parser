<?php

namespace LoveOSS\Github\EventType;

interface GithubEventInterface
{
    public static function fields(): array;

    public static function name(): string;

    public static function isValid(array $data): bool;

    public function createFromData(array $data): self;

    public function getPayload(): array;
}
