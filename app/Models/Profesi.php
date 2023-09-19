<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesi extends Model
{
    use HasFactory;

    protected $table = 'profesi';

    /**
     * relasi dengan tabel hasil_response
    */
    public function users()
    {
        return $this->hasMany(HasilResponse::class, 'profesi', 'id');
    }
}
