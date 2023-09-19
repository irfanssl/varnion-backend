<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisKelamin;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            '1' => 'Laki - laki', 
            '2' => 'Perempuan',
        ];
        // dd($array);
        foreach($array as $key => $value){
            JenisKelamin::create([
                'kode_kelamin' => $key,
                'kelamin' => $value
            ]);
        }
        
    }
}
