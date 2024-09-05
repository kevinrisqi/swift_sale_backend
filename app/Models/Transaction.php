<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_id',
        'user_id',
        'status',
        'payment_method',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Boot method to set the id_transaction before creating the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            // Generate the transaction ID
            $transaction->transaction_id = Transaction::generateIdTransaction();
        });
    }

    public static function generateIdTransaction()
    {
        $date = now()->format('ymd');

        $lastTransaction = Transaction::whereDate('created_at', now()->toDateString())->orderBy('id', 'desc')->first();

        if ($lastTransaction) {
            // Extract the last sequence number and increment it
            $lastSequence = intval(substr($lastTransaction->transaction_id, 9));
            $newSequence = str_pad($lastSequence + 1, 5, '0', STR_PAD_LEFT);
        } else {
            // Start at 00001 if no transactions today
            $newSequence = '00001';
        }

        // Combine to create the ID
        return 'TRX' . $date . $newSequence;
    }
}
