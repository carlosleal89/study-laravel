<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    //retorna todos os registros da tabela accounts
    public function index()
    {
        return response()->json(Account::all());
    }

    //retorna um registro pelo id
    public function show(Account $account)
    {
        return response()->json($account);
    }

    //cria um novo registro
    public function store(Request $request_body)
    {
        $validate = $request_body->validate([
            'account_name' => 'required',
            'app_key' => 'required|string',
            'app_token' => 'required|string',
            'info' => 'required|string',
            'product_catalog_id' => 'required|integer'
        ]);

        $account = Account::create($validate);
        return response()->json($account, 201);
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
    public function destroy(Account $account)
    {
        $account->delete();
        return response()->json(null, 204);
    }
}
