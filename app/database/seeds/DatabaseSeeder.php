<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


          $this->call([CurrencyTypeSeeder::class, CurrencyListSeeder::class, LanguageSeeder::class, PaymentMethodSeeder::class,SettingsSeeder::class,
         ]);

        //$this->call([PaymentMethodSeeder::class]);


    }
}
