<?php

namespace App\Http\Controllers;

use App\Exceptions\CnpjExisteException;
use App\Exceptions\CnpjInvalidoException;
use App\Exceptions\CpfCnpjInvalidoException;
use App\Exceptions\CpfExisteException;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FornecedorController extends Controller
{

    public function index()
    {
        try {
            $fornecedores = Fornecedor::all();

            return response()->json(['fornecedores' => $fornecedores, 'status' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro ao recuperar a lista de fornecedores'], 500);
        }
    }


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
                $verificarCnpjJaExiste = Fornecedor::where('cpf_cnpj', $request->cpf_cnpj)->first();

                if($verificarCnpjJaExiste){
                    throw new CnpjExisteException();
                }

                $verificarCnpjValido = Http::get('https://brasilapi.com.br/api/cnpj/v1/' . $cpf_cnpj);

                if ($verificarCnpjValido->successful()) {
                    $cnpjData = $verificarCnpjValido->json();
                } else {
                    throw new CnpjInvalidoException();
                }
            }

            else {
                throw new CpfCnpjInvalidoException();
            }

            $fornecedor = Fornecedor::create($request->all());

            return response()->json([
                'mensagem' => "Fornecedor cadastrado com sucesso!",
                'fornecedor' => $fornecedor,
                'status' => 201
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show(string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            return response()->json(['fornecedor' => $fornecedor, 'status' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Fornecedor não encontrado', 'status' => 404]);
        }
    }


    public function update(Request $request, string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            $fornecedor->update($request->all());

            return response()->json(['mensagem' => 'Fornecedor atualizado com sucesso!', 'fornecedor' => $fornecedor, 'status' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Fornecedor não encontrado', 'status' => 404]);
        }
    }

   public function destroy(string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);

            $fornecedor->delete();

            return response()->json(['mensagem' => 'Fornecedor excluido com sucesso', 'status' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Fornecedor não encontrado', 'status' => 404]);
        }
    }
}
