<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Account;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BatchController extends Controller
{
    public function generate(Request $request)
    {
        try {
            $validate = $request->validate([
                'accountName' => 'required|string',
                'productIds' => 'required|array',
                'productIds.*' => 'required|numeric|min:1',
                'batchName' => 'string'
            ]);

            $account_name = $request->accountName;
            $account = Account::where('account_name', $account_name)->first();

            // verifica se o accountName existe
            if (!$account) {
                Log::error("Conta não encontrada.");
                return response()->json([
                    'error' => 'Conta não encontrada.'
                ], 404);
            }

            // valida se todos os ids são números
            foreach ($request->productIds as $id) {
                if (!is_int($id)) {
                    Log::error("O campo productIds deve conter apenas números inteiros.");
                    return response()->json([
                        'error' => 'O campo productIds deve conter apenas números inteiros.'
                    ], 422);
                }
            }

            $batch_id = Str::uuid();

            // obtém a data e hora atual da classe Carbon
            $datetimeStr = Carbon::now()->format('d/m/Y H:i:s');

            // obtém 'batchName' do request ou usa um valor padrão
            $batchName = $request->input('batchName', "Lote {$datetimeStr}");

            // Cria o registro na tabela batches
            $batch = $this->store($account->id, $batch_id, $batchName);

            return response()->json([
                'success' => true,
                'data' => $batch
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            error_log("Erro: " . $e->getMessage());
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            error_log("Erro: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function store($accountName, $batch_id, $batch_name)
    {
        try {
            $batch = Batch::create([
                'account_name' => $accountName,
                'batchId' => $batch_id,
                'batchName' => $batch_name
            ]);

            Log::info("Batch criado com sucesso:", ['batch' => $batch]);

            return $batch;
        } catch (\Exception $e) {
            Log::error("Erro ao criar batch no banco: " . $e->getMessage());
            throw $e;
        }
    }
}
