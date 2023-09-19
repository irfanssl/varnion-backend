<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    use HasFactory;

    protected $table = 'jenis_kelamin';


    /**
     * relasi dengan tabel hasil_response
    */
    public function users()
    {
        return $this->hasMany(HasilResponse::class, 'jenis_kelamin', 'id');
    }
}
