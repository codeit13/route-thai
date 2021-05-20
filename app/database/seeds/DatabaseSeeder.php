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
        $this->call([
            CurrencyTypeSeeder::class,
            CurrencySeeder::class,
           	UserPaymentMethodSeed::class,
            LanguageSeeder::class
        ]);
    }
}
