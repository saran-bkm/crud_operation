<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;  
use Laravel\Sanctum\HasApiTokens;                        
use App\Models\Order;

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['name', 'email', 'phone', 'otp'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
