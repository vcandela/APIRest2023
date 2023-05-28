<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendTextMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'message',
        'text'
    ];
}
