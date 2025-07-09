<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LARA extends Model
{
    protected $table = 'laras';

    protected $fillable = [
        'title',
        'content',
        'file_path',
        'pemilik_id',
        'penerima_id',
        'is_released',
    ];

    protected $casts = [
        'is_released' => 'boolean',
    ];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
