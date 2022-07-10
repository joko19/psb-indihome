<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'name', 'address', 'typeIdentity', 'numberIdentity', 'phone', 'status', 'date', 'time', 'prepare', 'ontheway', 'process', 'finishing', 'endStep', 'day', 'teknisi'
    ];
}
