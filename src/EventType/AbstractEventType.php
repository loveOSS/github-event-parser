<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Integration;

abstract class AbstractEventType implements GithubEventInterface
{
    private array $data;

    public ?Integration $integration;

    public function getPayload(): array
    {
        return $this->data;
    }

    public static function fields(): array
    {
        return [];
    }

    public static function name(): string
    {
        return get_called_class();
    }

    public static function isValid(array $data): bool
    {
        foreach (static::fields() as $field) {
            if (!isset($data[$field]) && !array_key_exists($field, $data)) {
                return false;
            }
        }

        return true;
    }

    public function createFromData(array $data): self
    {
        $this->data = $data;

        $this->integration = isset($data['installation']) ? Integration::createFromData($data['installation']) : null;

        return $this;
    }
}
