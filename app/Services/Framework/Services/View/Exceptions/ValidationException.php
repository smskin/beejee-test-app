<?php


namespace App\Services\Framework\Services\View\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * @param array $messages
     * @throws ValidationException
     */
    public static function withMessages(array $messages){
        throw new ValidationException(json_encode((object)[
            'errors'=>$messages
        ]), 422);
    }
}