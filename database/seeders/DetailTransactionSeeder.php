<?php

namespace Database\Seeders;

use App\Models\DetailTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailTransaction::create([
            'transaction_id' => 1,
            'product_id' => 1,
            'quantity' => 5,
            'tax' => 11,
            'total_price' => 35000,
        ]);
    }
}
