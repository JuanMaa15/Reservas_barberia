<?php

namespace Database\Seeders;

use App\Models\Hour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i=9; $i <= 17; $i++) { 

        //     if ($i < 10) {
        //         DB::table('hours')->insert(['hora' => '0'.$i.':00']);
        //         DB::table('hours')->insert(['hora' => '0'.$i.':30']);
        //     }else{
        //         DB::table('hours')->insert(['hora' => $i.':00']);
        //         DB::table('hours')->insert(['hora' => $i.':30']);
        //     }  
                            
        // }

        $horas = [
            ['hora' => '09:00'],
            ['hora' => '10:00'],
            ['hora' => '11:00'],
            ['hora' => '12:00'],
            ['hora' => '13:00'],
            ['hora' => '14:00'],
            ['hora' => '15:00'],
            ['hora' => '16:00'],
            ['hora' => '17:00'],
        ];

        Hour::insert($horas);
    }
}
