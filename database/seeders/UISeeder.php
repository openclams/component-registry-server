<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try { 
            
            DB::unprepared(file_get_contents('database/seeders/setup.sql'));
          
        } catch (\Illuminate\Database\QueryException $ex) {
            
            dd($ex->getMessage());
            
        }
    }
}
