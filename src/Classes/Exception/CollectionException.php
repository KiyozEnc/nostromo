<?php

namespace Nostromo\Classes\Exception;

use Exception;

class CollectionException extends \Exception
{
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        $message = $message === null ? 'Key already in use.' : $message;
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__." : [{$this->code}] : {$this->message}\n";
    }
}
