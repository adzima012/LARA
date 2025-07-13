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
        'image_path',
        'pemilik_id',
        'recipient_email',
        'is_released',
    ];

    protected $casts = [
        'is_released' => 'boolean',
    ];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }
}
