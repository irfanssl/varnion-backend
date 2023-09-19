<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profesi;

class ProfesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'A' => 'Petani', 
            'B' => 'Teknisi', 
            'C'  => 'Guru', 
            'D'  => 'Nelayan', 
            'E'  => 'Seniman'
        ];
        // dd($array);
        foreach($array as $key => $value){
            Profesi::create([
                'kode_profesi' => $key,
                'profesi' => $value
            ]);
        }
        
    }
}
