<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([[
                'setting_title' => "Loan Price Down Limit",
                'setting_code' => "loan_price_down_limit",
                "setting_value" => "10"
            ],[
                'setting_title' => "Loan Min Percentage",
                'setting_code' => "loan_min_percentage",
                "setting_value" => "10"
            ],[
                'setting_title' => "Loan Max Percentage",
                'setting_code' => "loan_max_percentage",
                "setting_value" => "10"
            ],[
                'setting_title' => "Loan Repay Currency Type",
                'setting_code' => "loan_repay_currency_type",
                "setting_value" => "1"
            ]
        ]);
    }
}
