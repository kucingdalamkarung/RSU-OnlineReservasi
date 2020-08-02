<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PoliklinikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("poliklinik")->insert([
          "noPoli" => 1,
          "namaPoli" => "Poli Gigi"
        ]);
    }
}
