<?php

use Illuminate\Database\Seeder;

class DeductionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deductions')->insert([
            'pph_percentage' => 0,
            'bpjs_percentage' => 0
        ]);
    }
}
