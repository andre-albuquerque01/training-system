<?php

namespace App\Exceptions;

use Exception;

class WorkException extends Exception
{
    public $message = "Error";
    public function render()
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->message
        ], 500);
    }
}
