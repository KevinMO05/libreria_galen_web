<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['dni', 'first_name', 'last_name', 'address', 'phone'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'dni_client');
    }
}
