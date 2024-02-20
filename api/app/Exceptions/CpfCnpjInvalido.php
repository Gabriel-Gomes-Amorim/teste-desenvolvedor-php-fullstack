<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CpfCnpjInvalidoException extends Exception
{
    protected $message = 'CPF/CNPJ inválido!';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], $this->getCode());
    }
}
