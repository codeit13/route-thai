<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = new \App\Models\Language;
        if(!$language->where('name','English')->exists())
        {
        $language= $language->create(['name'=>'English','short_name'=>'en', 'is_default'=>1]); 
            $media = \MediaUploader::fromSource(public_path('front/img/GBP.svg'))
                               ->toDirectory('language-icons')
                               ->upload();
            $language->attachMedia($media,'icon');
        }
        if(!$language->where('name','Korean')->exists())
        { 

          $language=$language->create(['name'=>'Korean','short_name'=>'kr']); 
            $media = \MediaUploader::fromSource(public_path('front/img/kr.svg'))
                               ->toDirectory('language-icons')
                               ->upload();
            $language->attachMedia($media,'icon');
        }
        if(!$language->where('name','Thailand')->exists())
        { 

          $language=$language->create(['name'=>'Thailand','short_name'=>'th']); 
            $media = \MediaUploader::fromSource(public_path('front/img/th.svg'))
                               ->toDirectory('language-icons')
                               ->upload();
            $language->attachMedia($media,'icon');
        }
        if(!$language->where('name','Chinese')->exists())
        { 
          $language=$language->create(['name'=>'Chinese','short_name'=>'zh']); 
            $media = \MediaUploader::fromSource(public_path('front/img/cn.svg'))
                               ->toDirectory('language-icons')
                               ->upload();
            $language->attachMedia($media,'icon');
        }
        
        
    }
}
