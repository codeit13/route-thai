<?php
namespace App\Http\Traits;

use App\Helpers\FileHelp;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;

trait GenerateTransIDTrait {
	function random_string($length) {
	    $key = '';
	    $keys = array_merge(range(0, 9), range('a', 'z'));

	    for ($i = 0; $i < $length; $i++) {
	        $key .= $keys[array_rand($keys)];
	    }

	    return strtoupper($key);
	}

	public function generateID(){
		$refrence_id = '';
		do {
		   $refrence_id = random_string(8);
		} while ( Transaction::where('trans_id', $refrence_id )->exists() );

		return $refrence_id;
	}
}