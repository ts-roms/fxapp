<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('currency')->insert([
            [
                'name'          => 'PHP',
                'exchange_rate' => 50.000000,
                'base_currency' => 1,
                'status'        => 1,
            ],
        ]);
    }
}
