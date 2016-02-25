<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 20/02/2016
 * Time: 10:57
 */

namespace Nostromo\Classes\Exception;

/**
 * Class AccessDeniedException
 * @package Nostromo\Classes\Exception
 */
class AccessDeniedException extends \Exception
{
    /**
     * NotConnectedException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        $message = 'Accès refusé : '.$message;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}