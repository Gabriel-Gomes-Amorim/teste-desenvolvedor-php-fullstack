<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CpfExisteException extends Exception
{
    protected $message = 'CPF informado já existe!';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], $this->getCode());
    }
}
