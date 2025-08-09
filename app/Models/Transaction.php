<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Model;  

class Transaction extends Model  
{  
    protected $fillable = [  
        'cash_register_id',  
        'type',  
        'grams',  
        'purity',  
        'discount_percentage',  
        'price_per_gram_pen',  
        'price_per_gram_usd',  
        'price_per_oz',  
        'total_pen',  
        'total_usd',  
        'exchange_rate',  
        'hora',  
        'created_by',  
    ];  

    public function cashRegister()  
    {  
        return $this->belongsTo(CashRegister::class);  
    }  
}
