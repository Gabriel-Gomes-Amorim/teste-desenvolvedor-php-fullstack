<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CnpjExisteException extends Exception
{
    protected $message = 'CNPJ informado já existe!';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], $this->getCode());
    }
}
