<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseController extends Controller
{
    public function __construct()
    {
        // $this->firestore = app('firebase.firestore');
        // $this->data = $data;
    }

    public function save_Loan_To_Firebase()
    {   
        $projectId = "routethai-loan-liquidation";

        $db = new FirestoreClient([
            'projectId' => $projectId,
            'keyFile' => json_decode(file_get_contents(base_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true),
        ]);

        $results = DB::select('select * from loans');

        foreach($results as $data) {
            $db->collection('loans')->document($data->id)->set((array)$data);
        }
        
        return '__SUCCESS__';
    }
}
