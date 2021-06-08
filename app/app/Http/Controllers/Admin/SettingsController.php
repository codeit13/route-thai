<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\LoanTerms;
use App\Models\LoanRepayCurrency;
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




       }


      

       return $dropdowns;

    }

    public function loan_settings(Request $request) {
        $loanSettings=Settings::whereIn("setting_code",["loan_price_down_limit","loan_min_percentage","loan_max_percentage","loan_repay_currency_type"])->get();

        $settingValue = [];
        foreach ($loanSettings as $key => $value) {
          $settingValue[$value->setting_code] = $value->setting_value;
        }
        $dropdowns=$this->currenciesForDropDown();
        $lornTerms = LoanTerms::get();
        $cruptoCurrencies=\App\Models\Currency::where('is_crypto',1)->get();
        $loanRepay=LoanRepayCurrency::with('currency')->get();

        $actionName = $request->route()->getName();
        $editId = ($request->id)?$request->id:0;
        return view('back.settings.loan',compact('settingValue','dropdowns','lornTerms','cruptoCurrencies','loanRepay','actionName','editId'));
    }

    public function loan_settings_update(Request $request) {
      $adminId = Auth::user()->id;
      $request->validate([
        'loan_price_down_limit'=>'required|numeric|min:1|max:100',
        'loan_min_percentage'=>'required|numeric|min:1|max:100',
        'loan_max_percentage'=>'required|numeric|gt:loan_min_percentage|min:1|max:100'
      ]);

      try {
            Settings::where("setting_code","loan_price_down_limit")->update(["setting_value"=>$request->loan_price_down_limit,"updated_by"=>$adminId]);
            Settings::where("setting_code","loan_min_percentage")->update(["setting_value"=>$request->loan_min_percentage,"updated_by"=>$adminId]);
            Settings::where("setting_code","loan_max_percentage")->update(["setting_value"=>$request->loan_max_percentage,"updated_by"=>$adminId]);

            return redirect()->back()->with('success','Loan setting updated successfully');
            
        } catch (Throwable $exception) {
            return redirect()->back()->with('warning',$exception->getMessage());
        }
    }

    public function loan_terms_settings_update(Request $request) {
      try {
        if($request->btn_action=="update_record") {
          $rules = [];
          foreach($request->get('terms') as $key => $val) {
              $rules['terms.'.$key.'.percentage'] = 'required|numeric|min:1|max:100';
              $rules['terms.'.$key.'.duration'] = 'required|numeric|min:1';
              $rules['terms.'.$key.'.type'] = 'required';
          }
          $request->validate($rules);
          
          foreach($request->get('terms') as $key => $val) {
            LoanTerms::where("id",$key)->update(["terms_percentage"=>$val['percentage'],"no_of_duration"=>$val['duration'],"duration_type"=>$val['type']]);
          }
          return redirect()->back()->with('success','Loan terms updated successfully');
        } else if($request->btn_action=="new_record") {
          $request->validate([
            'terms_percentage'=>'required|numeric|min:1|max:100',
            'no_of_duration'=>'required|numeric|min:1',
            'duration_type'=>'required'
          ]);
          LoanTerms::insert($request->except(["_token","btn_action","terms"]));
          return redirect()->back()->with('success','Loan terms added successfully');
        } else {
          LoanTerms::destroy($request->btn_action);
          return redirect()->back()->with('success','Loan terms deleted successfully');
        }
          
      } catch (Throwable $exception) {
          return redirect()->back()->with('warning',$exception->getMessage());
      }
    }

    public function loan_terms_repay_update(Request $request) {
      $adminId = Auth::user()->id;
      try {
        if($request->btn_action=="update_record") {
          Settings::where('setting_code','loan_repay_currency_type')->update(['setting_value' => $request->loan_repay_currency_type,"updated_by"=>$adminId]);
          return redirect()->back()->with('success','Loan currency type update successfully');
        }else if($request->btn_action=="new_record") {
          $request->validate(['currency_id'=>'required','crypto_wallet_address'=>'required']);
          $request->merge(["updated_by"=>$adminId]);          
          LoanRepayCurrency::updateOrCreate(['currency_id'=>$request->currency_id],$request->except(["_token","btn_action","loan_repay_currency_type"]));

          return redirect()->back()->with('success','Loan currency added successfully');
        } else {
          LoanRepayCurrency::destroy($request->btn_action);
          return redirect()->back()->with('success','Loan currency deleted successfully');
        }
          
      } catch (Throwable $exception) {
          return redirect()->back()->with('warning',$exception->getMessage());
      }
    }

    public function loan_currency_update(Request $request,$id) {
      $request->validate([
        'currency_id'=>'required',
        'crypto_wallet_address'=>'required'
      ]);

      $loanCurData = LoanRepayCurrency::find($id);

      if($loanCurData) {
        // $loanCurData->currency_id = $request->currency_id;
        $loanCurData->crypto_wallet_address = $request->crypto_wallet_address;
        $loanCurData->update();
        return redirect()->route("admin.settings.loan")->with('success','Loan currency updated successfully');
      } else {
        return redirect()->route("admin.settings.loan")->with('warning','Loan currency record update failed');
      }
    }
}
