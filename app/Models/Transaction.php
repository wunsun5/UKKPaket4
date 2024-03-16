<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $guarded = [''];

    protected static function boot(){
        parent::boot();

        static::creating(function($transaction){
            return $transaction->id = static::generatePrimaryKey();
        });
    }

    public static function generatePrimaryKey(){
        $lastPrimaryKey = static::latest('id')->value('id');

        if(!$lastPrimaryKey){
            return 'T001';
        }

        $number = intval(substr($lastPrimaryKey, 1)) + 1;
        return 'T' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function scopeSearch($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('customer', function ($query) use ($search) {
                $query->where('nama_pelanggan', 'like', '%' . $search . '%');
            })->orWhere('id', 'like', '%' . $search . '%');
        });

        $query->when($filters['start_date'] ?? false, function ($query, $search){
            return $query->whereDate('created_at', '>=', $search);
        });

        $query->when($filters['end_date'] ?? false, function ($query, $search){
            return $query->whereDate('created_at', '<=', $search);
        });
    }

    public function details(){
        return $this->hasMany(DetailTransaction::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
