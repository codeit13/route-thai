<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CurrencyType= new \App\Models\CurrencyType;
        
    	if(!$CurrencyType->where('type','Crypto')->exists())
    	{

              $CurrencyType::create(['type'=>'Crypto']);
             

        }

        if(!$CurrencyType->where('type','Fiat')->exists())
    	{

             
              $CurrencyType::create(['type'=>'Fiat']);

        }
    }
}
