<?php
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 18/02/2016
 * Time: 20:46
 */

namespace Nostromo\Classes\Exception;

class ErrorSQLException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        $message = 'Erreur lors de l\'exécution de la requête : '.$message;
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__." : [{$this->code}] : {$this->message}\n";
    }
}
