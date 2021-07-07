<?php

namespace LoveOSS\Github\Exception;

use Exception;

class EventNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Not event can be related to this data.', 0, null);
    }
}
