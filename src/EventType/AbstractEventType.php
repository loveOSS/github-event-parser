<?php

namespace LoveOSS\Github\EventType;

use LoveOSS\Github\Entity\Integration;

abstract class AbstractEventType implements GithubEventInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var Integration|null
     */
    public $integration;

    public function getPayload()
    {
        return $this->data;
    }

    public static function fields()
    {
        return [];
    }

    public static function name()
    {
        return get_called_class();
    }

    public static function isValid($data)
    {
        foreach (static::fields() as $field) {
            if ((isset($data[$field]) || array_key_exists($field, $data)) === false) {
                return false;
            }
        }

        return true;
    }

    public function createFromData($data)
    {
        $this->data = $data;

        $this->integration = isset($data['installation']) ? Integration::createFromData($data['installation']) : null;

        return $this;
    }
}
