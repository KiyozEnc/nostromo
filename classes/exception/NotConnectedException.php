<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 18/02/2016
 * Time: 20:54
 */

namespace Nostromo\Classes\Exception;

class NotConnectedException extends \Exception
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
        $message = 'Vous n\'êtes pas connecté';
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
