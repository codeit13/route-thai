<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\LoanTerms;
use App\Models\LoanRepayCurrency;
use App\Models\CollateralAddress;
use Auth;

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

        if(!$request->has('loan'))
        {
            $request->merge(['loan'=>[]]);
        }
           Currency::whereNotIn('short_name',$request->loan)->update(['is_loanable' => 0]);
      
        
           Currency::whereIn('short_name',$request->loan)->update(['is_loanable' => 1]);

        return redirect()->route('admin.settings');
    }




    public function currenciesForDropDown()
    {
       $currencies=\App\Models\Currency::all();

       $dropdowns=[];

       $dropdowns['crypto']=$dropdowns['trade']=$dropdowns['fiat']=[];

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

        // loan

        if($currency->type_id==1 && $currency->is_crypto)
        {
             $row=array('id'=>$currency->id,'value'=>$currency->short_name,'selected'=>false);

            if($currency->hasMedia('icon'))
            {
               $row['label']='<img src="'.$currency->firstMedia('icon')->getUrl().'" class="mr-2" style="height: 25px; width: 25px;">'.$currency->short_name;
            }

            if($currency->is_loanable)
            {
                $row['selected']=true;           
            }

            $dropdowns['loan'][]=$row;
        }

        //end

         // collateral

        if($currency->type_id==1 && $currency->is_crypto)
        {
             $row=array('id'=>$currency->id,'value'=>$currency->short_name,'selected'=>false);

            if($currency->hasMedia('icon'))
            {
               $row['label']='<img src="'.$currency->firstMedia('icon')->getUrl().'" class="mr-2" style="height: 25px; width: 25px;">'.$currency->short_name;
            }

            if($currency->is_collateral)
            {
                $row['selected']=true;           
            }

            $dropdowns['collateral'][]=$row;
        }

        //end

        // repay

        if($currency->type_id==1 && $currency->is_crypto)
        {
             $row=array('id'=>$currency->id,'value'=>$currency->short_name,'selected'=>false);

            if($currency->hasMedia('icon'))
            {
               $row['label']='<img src="'.$currency->firstMedia('icon')->getUrl().'" class="mr-2" style="height: 25px; width: 25px;">'.$currency->short_name;
            }

            if($currency->loan_repay_currency)
            {
                $row['selected']=true;           
            }

            $dropdowns['repayment_currencies'][]=$row;
        }

        //end




       }


      

       return $dropdowns;

    }

    // Loan Setting Page
    public function loan_settings(Request $request) {
        $loanSettings=Settings::whereIn("setting_code",["loan_price_down_limit","loan_min_percentage","loan_max_percentage","loan_repay_currency_type","loan_interest_rate"])->get();

        $dropdowns=$this->currenciesForDropDown();
        $settingValue = [];
        foreach ($loanSettings as $key => $value) {
          $settingValue[$value->setting_code] = $value->setting_value;
        }
        $dropdowns=$this->currenciesForDropDown();
        $lornTerms = LoanTerms::get();
        $cruptoCurrencies=\App\Models\Currency::where('is_crypto',1)->get();
        $cryptoCurrencies = [];
        foreach ($cruptoCurrencies as $key => $currency) {
          $row = array('id'=>$currency->id,'value'=>$currency->id,'selected'=>false);
          if($currency->hasMedia('icon'))
            {
               $row['label']='<img src="'.$currency->firstMedia('icon')->getUrl().'" class="mr-2" style="height: 25px; width: 25px;">'.$currency->short_name;
            }
            $cryptoCurrencies[] = $row;
        }
        
        $collateralCruptoCurrencies=\App\Models\Currency::with(['collateral_address'])->where('is_collateral',1)->orderBy('updated_at','asc')->get();
        $loanRepay=LoanRepayCurrency::with('currency')->get();

        $actionName = $request->route()->getName();
        $editId = ($request->id)?$request->id:0;
        return view('back.settings.loan',compact('settingValue','dropdowns','lornTerms','cruptoCurrencies','cryptoCurrencies','loanRepay','actionName','editId','collateralCruptoCurrencies'));
    }

    // Application Loan Setting Save Method
    public function loan_settings_update(Request $request) {
      $adminId = Auth::user()->id;
      try {
        if($request->btn_action=="update_record") {
          $rules = [];
          foreach($request->get('terms') as $key => $val) {
              $rules['terms.'.$key.'.percentage'] = 'required|numeric|min:1|max:100';
              $rules['terms.'.$key.'.duration'] = 'required|numeric|min:1';
              $rules['terms.'.$key.'.type'] = 'required';
          }
          
          $rules['collateral_currency']='required|array|min:1';
          $rules['loanable_currency']='required|array|min:1';
          $rules['loan_price_down_limit']='required|numeric|min:1|max:100';
          $rules['loan_min_percentage']='required|numeric|min:1|max:100';
          $rules['loan_max_percentage']='required|numeric|gt:loan_min_percentage|min:1|max:100';
          $rules['loan_interest_rate']='required|numeric|gt:0';

          $request->validate($rules);

         //echo '<pre>';print_r($request->all());die;

        

          if(!$request->has('collateral_currency') && count($request->collateral_currency)<1)
        {
            $request->merge(['collateral_currency'=>[]]);
        }
           Currency::whereNotIn('short_name',$request->collateral_currency)->update(['is_collateral' => 0]);
         
           Currency::whereIn('short_name',$request->collateral_currency)->update(['is_collateral' => 1]);

           if(!$request->has('loanable_currency') && count($request->loanable_currency)<1)
        {
            $request->merge(['loanable_currency'=>[]]);
        }
           Currency::whereNotIn('short_name',$request->loanable_currency)->update(['is_loanable' => 0]);
         
           Currency::whereIn('short_name',$request->loanable_currency)->update(['is_loanable' => 1]);


          Settings::where("setting_code","loan_price_down_limit")->update(["setting_value"=>$request->loan_price_down_limit,"updated_by"=>$adminId]);
          Settings::where("setting_code","loan_min_percentage")->update(["setting_value"=>$request->loan_min_percentage,"updated_by"=>$adminId]);
          Settings::where("setting_code","loan_max_percentage")->update(["setting_value"=>$request->loan_max_percentage,"updated_by"=>$adminId]);
          Settings::updateOrCreate(["setting_code"=>"loan_interest_rate"],["setting_value"=>$request->loan_interest_rate,"updated_by"=>$adminId,'setting_title'=>'Loan Interest Rate']);
          
          foreach($request->get('terms') as $key => $val) {
            LoanTerms::where("id",$key)->update(["terms_percentage"=>$val['percentage'],"no_of_duration"=>$val['duration'],"duration_type"=>$val['type']]);
          }

          if($request->has('collateral_crypto_rows'))
          {
            $this->collateral_update($request);
          }
          return redirect()->back()->with('success','Loan application setting updated successfully');
        } else if($request->btn_action=="new_record") {
          $request->validate([
            'terms_percentage'=>'required|numeric|min:1|max:100',
            'no_of_duration'=>'required|numeric|min:1',
            'duration_type'=>'required'
          ]);
          LoanTerms::insert(["terms_percentage"=>$request->terms_percentage,"no_of_duration"=>$request->no_of_duration,"duration_type"=>$request->duration_type]);
          return redirect()->back()->with('success','Loan term added successfully');
        } else {
          LoanTerms::destroy($request->btn_action);
          return redirect()->back()->with('success','Loan term deleted successfully');
        }
          
      } catch (Throwable $exception) {
          return redirect()->back()->with('warning',$exception->getMessage());
      }
    }

    // public function loan_terms_repay_update(Request $request) {

    //   echo '<pre>';print_r($request->all());die;
    //   $adminId = Auth::user()->id;
    //   try {
    //     if($request->btn_action=="update_record") {
    //       Settings::where('setting_code','loan_repay_currency_type')->update(['setting_value' => $request->loan_repay_currency_type,"updated_by"=>$adminId]);
    //       return redirect()->back()->with('success','Loan currency type update successfully');
    //     }else if($request->btn_action=="new_record") {
    //       $request->validate(['currency_id'=>'required','crypto_wallet_address'=>'required']);
    //       LoanRepayCurrency::updateOrCreate(['currency_id'=>$request->currency_id],["currency_id"=>$request->currency_id,"crypto_wallet_address"=>$request->crypto_wallet_address,'crypto_wallet_memo'=>$request->crypto_wallet_memo,"updated_by"=>$adminId]);

    //       return redirect()->back()->with('success','Loan currency added successfully');
    //     } else {
    //       LoanRepayCurrency::destroy($request->btn_action);
    //       return redirect()->back()->with('success','Loan currency deleted successfully');
    //     }
          
    //   } catch (Throwable $exception) {
    //       return redirect()->back()->with('warning',$exception->getMessage());
    //   }
    // }

    public function loan_terms_repay_update(Request $request) {

    //  echo '<pre>';print_r($request->all());die;
      $adminId = Auth::user()->id;
      try {
        
          Settings::where('setting_code','loan_repay_currency_type')->update(['setting_value' => $request->loan_repay_currency_type,"updated_by"=>$adminId]);

          if($request->has('repayment_currencies') && count($request->repayment_currencies))
          {
              $ids=\App\Models\Currency::whereIn('short_name',$request->repayment_currencies)->pluck('id');

              foreach ($ids as $key => $id) {

                 if(!LoanRepayCurrency::where('currency_id',$id)->exists())
                 {
                    LoanRepayCurrency::create(['currency_id'=>$id,'crypto_wallet_address'=>'','updated_by'=>$adminId]);
                 }
                 
                 
              }


             if($request->has('collateral_crypto_rows') && count($request->collateral_crypto_rows))
             {
              foreach ($request->collateral_crypto_rows as $key => $value) {
                 
                LoanRepayCurrency::where('currency_id',$value['currency_id'])->update(array('crypto_wallet_address'=>$value['crypto_wallet_address'],'crypto_wallet_memo'=>$value['crypto_wallet_memo']));

              }
            } 

              LoanRepayCurrency::whereNotIn('currency_id',$ids)->delete();

          }
          return redirect()->back()->with('success','Loan currency type update successfully');
        
          
      } catch (Throwable $exception) {
          return redirect()->back()->with('warning',$exception->getMessage());
      }
    }

    public function loan_currency_update(Request $request,$id) {
      $request->validate([
        // 'currency_id'=>'required',
        'crypto_wallet_address'=>'required'
      ]);

      $loanCurData = LoanRepayCurrency::find($id);

      if($loanCurData) {
        // dd("Yes");
        // $loanCurData->currency_id = $request->currency_id;
        $loanCurData->crypto_wallet_address = $request->crypto_wallet_address;
        $loanCurData->crypto_wallet_memo=$request->crypto_wallet_memo;
        $loanCurData->update();
        return redirect()->route("admin.settings.loan")->with('success','Loan currency updated successfully');
      } else {
        return redirect()->route("admin.settings.loan")->with('warning','Loan currency record update failed');
      }
    }

    // public function collateral_address_update(Request $request) {
    //   $adminId = Auth::user()->id;
    //   foreach ($request->crypto_wallet_address as $key => $value) {
    //     CollateralAddress::updateOrCreate(['currency_id'=>$key],["currency_id"=>$key,"crypto_wallet_address"=>$value,"updated_by"=>$adminId]);
    //   }
    //   return redirect()->back()->with('success','Collateral address attached successfully');
    // }


     public function collateral_update($request) {
      $adminId = Auth::user()->id;

      
  // echo '<pre';print_r($request->collateral_crypto_rows);die;
      foreach ($request->collateral_crypto_rows as $key => $value) {

        $value['crypto_address']=$value['crypto_address']?$value['crypto_address']:'';

   //      $newvalue=(object)$value;
   // echo '<pre>';print_r($newvalue->currency_id);die;

        CollateralAddress::updateOrCreate(['currency_id'=>$value['currency_id']],["currency_id"=>$value['currency_id'],"crypto_wallet_address"=>$value['crypto_address'],'crypto_memo'=>$value['crypto_memo'],"updated_by"=>$adminId]);
      }
    
    }
}
