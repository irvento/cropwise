<?php

namespace App\Services;

use App\Models\Finance;
use App\Models\FinanceTransaction;
use Illuminate\Support\Facades\DB;

class FinanceService
{
    /**
     * Create a financial transaction and update the account balance.
     */
    public function createTransaction(array $data): FinanceTransaction
    {
        return DB::transaction(function () use ($data) {
            $account = Finance::findOrFail($data['account_id']);

            $transaction = FinanceTransaction::create([
                'account_id' => $data['account_id'],
                'type' => $data['type'],
                'category' => $data['category'],
                'amount' => $data['amount'],
                'date' => $data['date'] ?? now(),
                'description' => $data['description'] ?? null,
                'reference_number' => $data['reference_number'] ?? null,
                'related_entity_type' => $data['related_entity_type'] ?? null,
                'related_entity_id' => $data['related_entity_id'] ?? null,
            ]);

            // Update balance
            if ($data['type'] === 'income') {
                $account->increment('balance', $data['amount']);
            } else {
                $account->decrement('balance', $data['amount']);
            }

            return $transaction;
        });
    }

    /**
     * Create a new financial account.
     */
    public function createAccount(array $data): Finance
    {
        return Finance::create($data);
    }
}
