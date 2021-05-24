<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pm= new \App\Models\PaymentMethods;
    	if(!$pm->where('name','UPI')->exists())
    	{
             $pm= $pm::create(['name'=>'UPI', 'status' => 'active' ]);
             $media = \MediaUploader::fromSource(public_path('front/img/ba_icon_1.png'))
                               ->toDirectory('p-methods_icon')
                               ->upload();
             $pm->attachMedia($media,'icon');
        }

        if(!$pm->where('name','Bank')->exists())
    	{
             $pm= $pm::create(['name'=>'Bank', 'status' => 'active' ]);
             $media = \MediaUploader::fromSource(public_path('front/img/ba_icon_2.png'))
                               ->toDirectory('p-methods_icon')
                               ->upload();
             $pm->attachMedia($media,'icon');
        }

        if(!$pm->where('name','IMPS')->exists())
    	{
             $pm= $pm::create(['name'=>'IMPS', 'status' => 'active' ]);
             $media = \MediaUploader::fromSource(public_path('front/img/ba_icon_3.png'))
                               ->toDirectory('p-methods_icon')
                               ->upload();
             $pm->attachMedia($media,'icon');
        }
    }
}
