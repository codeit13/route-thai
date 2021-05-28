<?php
namespace App\Http\Traits;

use App\Helpers\FileHelp;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;

trait GenerateTransIDTrait {
	public function generateID(){
		$refrence_id = '';
		do {
		   $refrence_id = generate_unique_id();
		} while ( Transaction::where('trans_id', $refrence_id )->exists() );

		return $refrence_id;
	}
}