<?php

namespace LoveOSS\Github\Exception;

use Exception;

class RepositoryNotFoundException extends Exception
{
    public function __construct($errorMessage)
    {
        $exceptionMessage = sprintf("A repository can't be extracted from data: %s", $errorMessage);

        parent::__construct($exceptionMessage, 0, null);
    }
}
