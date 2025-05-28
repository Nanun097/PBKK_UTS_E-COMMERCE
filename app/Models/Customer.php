<?php

// Model 1: Customer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Customer extends Model
{
    use HasFactory, HasUlids;

    protected $primaryKey = 'customer_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address'
    ];

    protected $hidden = [
        'password'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }
}