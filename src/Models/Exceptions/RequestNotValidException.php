<?php

namespace LUIS\Models\Exceptions;

class RequestNotValidException extends \Exception {

    public function __construct($errors = [], $code = 500)
    {
        $message = "--- Response not valid. Report of errors: \n";

        $message .= array_reduce($errors, function ($carry, $error) {
                $carry = (string) $carry;
                $carry .= $error['pointer'] .  ' -> error: ' . $error['message'] . "\n";

                return $carry;
            }) . "\n";

        parent::__construct($message, $code);
    }

}