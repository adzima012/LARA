<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LARA extends Model
{
    use HasFactory;
    protected $table = 'laras';

    protected $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
