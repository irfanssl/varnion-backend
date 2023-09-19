<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HasilResponse extends Model
{
    use HasFactory;

    protected $table = 'hasil_response';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis_kelamin',
        'nama',
        'nama_jalan',
        'email',
        'angka_kurang',
        'angka_lebih',
        'profesi',
        'plain_json'
    ];

    
    /**
     * relasi dengan tabel jenis_kelamin
     */
    public function jk(): HasOne
    {
        return $this->hasOne(JenisKelamin::class, 'id', 'jenis_kelamin');
    }

    /**
     * relasi dengan tabel profesi
     */
    public function namaProfesi(): HasOne
    {
        return $this->hasOne(Profesi::class, 'id', 'profesi');
    }
}
