<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency= new \App\Models\Currency;
    	if(!$currency->where('name','Bitcoin')->exists())
    	{

             $currency= $currency::create(['name'=>'Bitcoin',
              	                     'short_name'=>'BTC',
              	                     'type_id'=>1,
              	                    
          ]);

              $media=\MediaUploader::fromSource(public_path('front/img/bitcoin.png'))
                               ->toDirectory('currency-icons')
                               ->upload();

              $currency->attachMedia($media,'icon');

          }

              //second row

              $currency2= new \App\Models\Currency;

              	if(!$currency2->where('name','Ethereum')->exists())
    	{


              $currency2= $currency2::create(['name'=>'Ethereum',
              	                     'short_name'=>'ETH',
              	                     'type_id'=>1,
              	                    
             ]);

              $media=\MediaUploader::fromSource(public_path('front/img/icon-5.png'))
                               ->toDirectory('currency-icons')
                               ->upload();

              $currency2->attachMedia($media,'icon');

          }

              //third row

               $currency3= new \App\Models\Currency;

                    	if(!$currency3->where('name','BNB')->exists())
    	{


              $currency3= $currency3::create(['name'=>'BNB',
              	                     'short_name'=>'BNB',
              	                     'type_id'=>1,
              	                    
             ]);

              $media=\MediaUploader::fromSource(public_path('front/img/icon-6.png'))
                               ->toDirectory('currency-icons')
                               ->upload();

              $currency3->attachMedia($media,'icon');




        }

        //forth row

               $currency4= new \App\Models\Currency;

                      if(!$currency4->where('name','BNB')->where('type_id',2)->exists())
      {


              $currency4= $currency4::create(['name'=>'BNB',
                                     'short_name'=>'BNB',
                                     'type_id'=>2,
                                    
             ]);

              $media=\MediaUploader::fromSource(public_path('front/img/icon-6.png'))
                               ->toDirectory('currency-icons')
                               ->upload();

              $currency4->attachMedia($media,'icon');




        }

        //fifth row
    $currency5= new \App\Models\Currency;

                if(!$currency5->where('name','Ethereum')->where('type_id',2)->exists())
      {


              $currency5= $currency5::create(['name'=>'Ethereum',
                                     'short_name'=>'ETH',
                                     'type_id'=>2,
                                    
             ]);

              $media=\MediaUploader::fromSource(public_path('front/img/icon-5.png'))
                               ->toDirectory('currency-icons')
                               ->upload();

              $currency5->attachMedia($media,'icon');

          }
    }
}
