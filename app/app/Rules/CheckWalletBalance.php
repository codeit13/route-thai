<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckWalletBalance implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request,$type='')
    {
        $this->input=$request;

        $this->type=$type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

          $wallet=\Auth::user()->wallet()->where('currency_id',$this->input->currency_id);

        
          if($this->type)
          {
            $wallet=$wallet->where('wallet_type',$this->type);
          }
          else
          {
            $wallet=$wallet->where('wallet_type','!=',3);
          }

          $wallet=$wallet->first();

          return $value <=($wallet->coin??0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be less than available balance.';
    }
}
