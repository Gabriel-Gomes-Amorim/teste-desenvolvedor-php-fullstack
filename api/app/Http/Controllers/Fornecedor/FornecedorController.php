<?php

namespace App\Http\Controllers;

use App\Exceptions\CnpjExisteException;
use App\Exceptions\CpfCnpjInvalidoException;
use App\Exceptions\CpfExisteException;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required',
                'cpf_cnpj' => 'required',
                'contato' => 'required',
                'endereco' => 'required',
                'tipo_servico' => 'required',
                'representante' => 'required',
            ]);

            // Remove caracteres especiais do CPF/CNPJ
            $cpf_cnpj = preg_replace('/[^0-9]/', '', $request->cpf_cnpj);

            if (strlen($cpf_cnpj) === 11) {
                $verificarCpfJaExiste = Fornecedor::where('cpf_cnpj', $request->cpf_cnpj)->first();

                if($verificarCpfJaExiste) {
                    throw new CpfExisteException();
                }
            }

            elseif (strlen($cpf_cnpj) === 14) {
                $verificarCpfJaExiste = Fornecedor::where('cpf_cnpj', $request->cpf_cnpj)->first();

                if($verificarCpfJaExiste){
                    throw new CnpjExisteException();
                }

                /*try {
                    $verificarCnpjValido = Http::get('https://brasilapi.com.br/api/cnpj/v1/' . $cpf_cnpj);

                    return
                } catch (\Throwable $th) {
                    throw $th;
                }*/
            }

            else {
                throw new CpfCnpjInvalidoException();
            }

            $fornecedor = Fornecedor::create($request->all());

            return response()->json([
                'message' => "Fornecedor cadastrado com sucesso!",
                $fornecedor,
                201
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show(string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            return response()->json($fornecedor, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }
    }


    public function update(Request $request, string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            $fornecedor->update($request->all());

            return response()->json(['message' => 'Fornecedor atualizado com sucesso!', $fornecedor, 200]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }
    }

   public function destroy(string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            $fornecedor->delete();

            return response()->json(['message' => 'Fornecedor removido com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }
    }
}
