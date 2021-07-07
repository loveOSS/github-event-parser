<?php

namespace LoveOSS\Github\Exception;

class AllowUrlFileOpenException extends InvalidPhpConfigurationException
{
    public function __construct()
    {
        parent::__construct(
            'You need to set "allow_url_fopen" option in PHP configuration.',
            0,
            null
        );
    }
}
