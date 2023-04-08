<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class hours_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=9; $i <= 17; $i++) { 

            if ($i < 10) {
                DB::table('hours')->insert([
                    'hora' => '0'.$i.':00'
                ]);

                DB::table('hours')->insert([
                    'hora' => '0'.$i.':30'
                ]);
            }else{
                DB::table('hours')->insert([
                    'hora' => $i.':00'
                ]);
                DB::table('hours')->insert([
                    'hora' => $i.':30'
                ]);
            }
                  
        }
    }
}
