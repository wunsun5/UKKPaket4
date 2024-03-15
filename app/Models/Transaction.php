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

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
