<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    //retorna todos os registros da tabela accounts
    public function index()
    {
        try {
            $accounts = Account::all();
            
            return response()->json($accounts);
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            error_log("Erro ao listar contas: " . $error_message);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //retorna um registro pelo id
    public function show(int $id)
    {
        try {
            $account = Account::find($id);

            if (!$account) {
                error_log("Conta não encontrada com ID: " . $id);
                return response()->json(['error' => 'Conta não encontrada'], 404);
            }

            return response()->json($account);
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            error_log("Erro ao buscar conta: " . $error_message);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    //cria um novo registro
    public function store(Request $request_body)
    {
        try {
            $validate = $request_body->validate([
                'account_name' => 'required',
                'app_key' => 'required|string',
                'app_token' => 'required|string',
                'info' => 'required|string',
                'product_catalog_id' => 'required|integer'
            ]);

            // verifica se o campo product_catalog_id é um número
            if (!is_int($request_body->input('product_catalog_id'))) {
                error_log("O campo product_catalog_id deve ser um número.");
                return response()->json(['error' => 'O campo product_catalog_id deve ser um número.'], 422);
            }

            $account = Account::create($validate);
            return response()->json($account, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            error_log("Erro: " . $e->getMessage());
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar conta: ' . $e->getMessage()], 500);
        }
    }


    //atualiza um registro pelo id
    public function update(Request $request_body, Account $account)
    {
        $validate = $request_body->validate([
            'account_name' => 'required',
            'app_key' => 'required|string',
            'app_token' => 'required|string',
            'info' => 'required|string',
            'product_catalog_id' => 'required|integer'
        ]);

        $account->update($validate);
        return response()->json($account, 200);   
    }

    //deleta um registro pelo id
    public function destroy(int $id)
    {
        try {
            $account = Account::find($id);

            if (!$account) {
                error_log("Conta não encontrada com ID: " . $id);
                return response()->json(['error' => 'Conta não encontrada'], 404);
            }

            $account->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            error_log("Erro ao buscar conta: " . $error_message);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
