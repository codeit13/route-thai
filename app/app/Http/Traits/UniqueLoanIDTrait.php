<?php
namespace App\Http\Traits;

// use App\Helpers\FileHelp;
// use Illuminate\Support\Facades\Storage;
use App\Models\Loan;

trait UniqueLoanIDTrait {
	public function generateID(){
		$refrence_id = '';
		do {
		   $refrence_id = generate_unique_id();
		} while ( Loan::where('loan_id', $refrence_id )->exists() );

		return $refrence_id;
	}
}