<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CnpjInvalidoException extends Exception
{
    protected $message = 'CNPJ informado é inválido!';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function render($request)
    {
        return response()->json(['mensagem' => $this->getMessage(), 'status' => $this->getCode()], $this->getCode());
    }
}
