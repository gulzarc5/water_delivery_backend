<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignupOtp extends Model
{
   protected $table='signup_otps';
   protected $fillable=['mobile','otp'];
}
