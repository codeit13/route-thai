<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class SettingsController extends Controller
{
    
   public function index(){

      $dropdowns=$this->currenciesForDropDown();

    //  echo '<pre>';print_r($dropdowns);die;
       return view('back.settings',compact('dropdowns'));
   }     

   public function update(Request $request){
       
        // dd($request);
        if(!$request->has('trade'))
        {
            $request->merge(['trade'=>[]]);
        }
           Currency::whereNotIn('short_name',$request->trade)->update(['is_tradable' => 0]);
      
        
           Currency::whereIn('short_name',$request->trade)->update(['is_tradable' => 1]);
      
        if(!$request->has('crypto'))
        {
            $request->merge(['crypto'=>[]]);
        }
           Currency::whereNotIn('short_name',$request->crypto)->update(['is_crypto' => 0]);
      
        
           Currency::whereIn('short_name',$request->crypto)->update(['is_crypto' => 1]);

         if(!$request->has('fiat'))
        {
            $request->merge(['fiat'=>[]]);
        }
           Currency::whereNotIn('short_name',$request->fiat)->update(['is_fiat' => 0]);
      
        
           Currency::whereIn('short_name',$request->fiat)->update(['is_fiat' => 1]);

        return redirect()->route('admin.settings');
    }




    public function currenciesForDropDown()
    {
       $currencies=\App\Models\Currency::all();

       $dropdowns=[];

       foreach ($currencies as $key => $currency) {

        //crypto

        if($currency->type_id==1)
        {
            $row=array('id'=>$currency->id,'value'=>$currency->short_name,'selected'=>false);

            if($currency->hasMedia('icon'))
            {
               $row['label']='<img src="'.$currency->firstMedia('icon')->getUrl().'" class="mr-2" style="height: 25px; width: 25px;">'.$currency->short_name;
            }

            if($currency->is_crypto)
            {
                $row['selected']=true;           
            }

            $dropdowns['crypto'][]=$row;

           
        }

        //end crypto

        //fiat 

        if($currency->type_id==2)
        {
             $row=array('id'=>$currency->id,'value'=>$currency->short_name,'selected'=>false);

            if($currency->hasMedia('icon'))
            {
               $row['label']='<img src="'.$currency->firstMedia('icon')->getUrl().'" class="mr-2" style="height: 25px; width: 25px;">'.$currency->short_name;
            }

            if($currency->is_fiat)
            {
                $row['selected']=true;           
            }

            $dropdowns['fiat'][]=$row;
        }

         //end

        // trade

        if($currency->type_id==1 && $currency->is_crypto)
        {
             $row=array('id'=>$currency->id,'value'=>$currency->short_name,'selected'=>false);

            if($currency->hasMedia('icon'))
            {
               $row['label']='<img src="'.$currency->firstMedia('icon')->getUrl().'" class="mr-2" style="height: 25px; width: 25px;">'.$currency->short_name;
            }

            if($currency->is_tradable)
            {
                $row['selected']=true;           
            }

            $dropdowns['trade'][]=$row;
        }

        //end




       }


      

       return $dropdowns;

    }
}
