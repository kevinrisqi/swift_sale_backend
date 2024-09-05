<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer',
            'payment_method' => 'required|in:CASH,CREDIT_CARD',
            'total_price' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            /// * calculate the total price
            $totalPrice = collect($validateData['products'])->sum(function ($product) {
                $productModel = Product::find($product['product_id']);
                return $productModel->selling_price * $product['quantity'];
            });

            /// * validate the total price
            if ($totalPrice !== $validateData['total_price']) {
                return ResponseFormatter::error([
                    'message' => 'Invalid total price',
                ], 'Invalid total price', 400);
            }

            $transaction = Transaction::create([
                'transaction_id' => Transaction::generateIdTransaction(),
                'user_id' => $validateData['user_id'],
                'status' => 'PENDING',
                'payment_method' => $validateData['payment_method'],
                'total_price' => $validateData['total_price'],
            ]);

            /// * store the transaction details
            foreach ($validateData['products'] as $product) {
                $productModel = Product::find($product['product_id']);

                DetailTransaction::create([
                    'transaction_id' => $transaction->transaction_id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'tax' => 0,
                    'total_price' => $productModel->selling_price * $product['quantity'],
                ]);

                /// * update the stock
                $productModel->decrement('stock', $product['quantity']);
            }

            DB::commit();

            return ResponseFormatter::success($transaction, 'Transaction Success', 201);
        } catch (\Throwable $th) {
            DB::rollBack();

            return ResponseFormatter::error([
                'message' => $th->getMessage(),
            ], 'Transaction Failed', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
