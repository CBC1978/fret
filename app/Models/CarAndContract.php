<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAndContract extends Model
{
    

    protected $table = 'car_and_contract';

    protected $fillable = [
        'fk_contract_transport_id',
        'fk_car_id',
    ];
}
