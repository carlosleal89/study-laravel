<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Account;
use Illuminate\Support\Facades\Log;

class BatchController extends Controller
{
    public function generate(Request $request)
    {
        try {
            $validate = $request->validate([
                'accountName' => 'required',
                'productIds' => 'required|array',
                'productIds.*' => 'required|numeric|min:1',
                'batchName' => 'required|string'
            ]);

            // valida se todos os ids são números
            foreach ($request->productIds as $id) {
                if (!is_int($id)) {
                    Log::error("O campo productIds deve conter apenas números inteiros.");
                    return response()->json([
                        'error' => 'O campo productIds deve conter apenas números inteiros.'
                    ], 422);
                }
            }

            $account_name = $request->accountName;
            $account = Account::where('account_name', $account_name)->first();

            return response()->json($account);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            error_log("Erro: " . $e->getMessage());
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            error_log("Erro: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
