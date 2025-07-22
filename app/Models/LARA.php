<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model LARA (Life Archive Records Access)
 * 
 * Model ini merepresentasikan surat digital dalam sistem LARA.
 * Setiap surat memiliki pemilik, penerima, dan konten yang akan
 * disampaikan pada waktu yang ditentukan.
 */
class LARA extends Model
{
    /**
     * Nama tabel yang digunakan dalam database
     */
    protected $table = 'laras';

    /**
     * Atribut yang dapat diisi secara massal
     * 
     * @var array
     * 
     * title: Judul surat digital
     * content: Isi surat digital
     * file_path: Path ke file lampiran (jika ada)
     * image_path: Path ke gambar lampiran (jika ada)
     * pemilik_id: ID pengguna pemilik surat
     * recipient_email: Email penerima surat
     * is_released: Status apakah surat sudah dirilis
     */
    protected $fillable = [
        'title',
        'content',
        'file_path',
        'image_path',
        'pemilik_id',
        'recipient_email',
        'is_released',
    ];

    /**
     * Konversi tipe data kolom
     * 
     * @var array
     */
    protected $casts = [
        'is_released' => 'boolean', // Konversi is_released ke tipe boolean
    ];

    /**
     * Relasi ke model User sebagai pemilik surat
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }
}
