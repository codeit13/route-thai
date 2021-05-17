<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPaymentMethod;
use App\Models\PaymentMethod;
use App\Models\User;

class UserPaymentMethodSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::first();

    	$payment_methods = [
    		[
    			'name' => 'IMPS',
    			'status' => 'active'
    		],
    		[
    			'name' => 'Bank Transfer (India)',
    			'status' => 'active'
    		],
    		[
    			'name' => 'UPI',
    			'status' => 'active'
    		],
    	];

    	foreach ($payment_methods as $key => $single_payment_method) {
    		PaymentMethod::create($single_payment_method);
    	}

        $user_payment_methods_array = [
        	[
        		'account_number' => '5027101002482',
	        	'account_label' => 'Bank Account Number',
	        	'user_id' => $user->id,
	        	'payment_method_id' => PaymentMethod::where('name','IMPS')->value('id'),
	        	'status' => 'active',
	        	'code' => 'CNRB0005027',
	        	'code_label' => 'IFSC CODE',
	        	'icon' => 'front/img/icon-23.png'
        	],
        	[
        		'account_number' => '5027101002483',
	        	'account_label' => 'Bank Account Number',
	        	'user_id' => $user->id,
	        	'payment_method_id' => PaymentMethod::where('name','Bank Transfer (India)')->value('id'),
	        	'status' => 'active',
	        	'code' => 'CNRB0005028',
	        	'code_label' => 'IFSC CODE',
	        	'icon' => 'front/img/icon-25.png'
        	],
        	[
        		'account_number' => '9027022303@paytm',
	        	'account_label' => 'UPI ID',
	        	'user_id' => $user->id,
	        	'payment_method_id' => PaymentMethod::where('name','UPI')->value('id'),
	        	'status' => 'active',
	        	'icon' => 'front/img/icon-24.png'
        	]
        ];

        foreach ($user_payment_methods_array as $key => $single_user_payment_method) {
        	$icon = $single_user_payment_method['icon'];
        	unset($single_user_payment_method['icon']);

        	$save_user_payment_method = new UserPaymentMethod($single_user_payment_method);
        	$save_user_payment_method->save();

        	$media= \MediaUploader::fromSource(public_path($icon))
		                               ->toDirectory('payment-method-icons')
		                               ->upload();

			$save_user_payment_method->attachMedia($media,'icon');		                               
        }
    }
}
