<?php

namespace LoveOSS\Github\Exception;

class UserAgentNotFoundException extends InvalidPhpConfigurationException
{
    public function __construct()
    {
        parent::__construct('You need to set user agent to execute this query.', 0, null);
    }
}
