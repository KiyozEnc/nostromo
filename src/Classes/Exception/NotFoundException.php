<?php

namespace Nostromo\Classes\Exception;

use Exception;

class NotFoundException extends \Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct('Page introuvable '.$message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__.": [{$this->code}]: {$this->message}\n";
    }
}
