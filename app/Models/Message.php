<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
protected $fillable = [
    'recipient_name',
    'recipient_email',
    'delivery_schedule',
    'message',
    'repeat_yearly',
    'user_id',
];
}
