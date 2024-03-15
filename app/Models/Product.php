<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $guarded = [''];

    protected static function boot(){
        parent::boot();

        static::creating(function($product){
            return $product->id = static::generatePrimaryKey();
        });
    }

    public static function generatePrimaryKey(){
        $lastPrimaryKey = static::latest('id')->value('id');

        if(!$lastPrimaryKey){
            return 'P001';
        }

        $number = intval(substr($lastPrimaryKey, 1)) + 1;
        return 'P' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
