<?php

namespace LoveOSS\Github\EventType;

/**
 * Made the event actionable
 * Made the system aware that this event have an action.
 */
interface ActionableEventInterface
{
    /**
     * @return string action name
     */
    public function getAction();
}
