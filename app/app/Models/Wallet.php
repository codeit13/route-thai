<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Wallet extends Model
{
    use HasFactory;

    protected $table='wallet';

    protected $fillable=['coin','currency_id','wallet_type'];
    protected $appends = ['current_balance'];

    public function getCurrentBalanceAttribute()
    {
        $balance_pending = Transaction::where('currency_id',$this->currency_id)
                                            ->where('user_id',auth()->user()->id)
                                            ->where('status','pending')
                                            ->where('type','sell')
                                            ->sum('quantity');
        return $this->coin-$balance_pending;
    }

    public function scopeFilters($query, $filters = [])
    {
        if (!empty($filters['user_id'])) {
            $query->where('user_id', is_array($filters['user_id']) ? $filters['user_id'] : array($filters['user_id']));
        }
        if (!empty($filters['wallet_type'])) {
            $query->where('wallet_type', is_array($filters['wallet_type']) ? $filters['wallet_type'] : array($filters['wallet_type']));
        }
        return $query;
    }

    /**
     * @param array $filters
     * @param string $order_by
     * @param bool $associative
     * @return array
     */
    public static function toOptionList($filters = [])
    {
        $wallet_amount = Wallet::Filters($filters)->get();

        $items = [];
        /** @var \App\User $i */
        foreach ($wallet_amount as $i) {
            $items[$i->currency_id] = $i->current_balance;
        }
        return $items;
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function currency()
    {
    	return $this->belongsTo('App\Models\Currency','currency_id','id');
    }
}
