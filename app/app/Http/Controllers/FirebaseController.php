<?php

namespace App\Http\Controllers;

// namespace Google\Cloud\Samples\Firestore;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected $database;
    protected $data;

    public function __construct()
    {   
        // $this->firestore = app('firebase.firestore');
        // $this->data = $data;
    }

    public function save_Loan_To_Firebase() {

        $projectId = "routethai-loan-liquidation";
        
        $db = new FirestoreClient([
            'projectId' => $projectId,
            'keyFile' => json_decode(file_get_contents(base_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true),
        ]);

        $data = [
            'name' => 'Los Angeles',
            'state' => 'C',
            'country' => 'USA'
        ];
        $db->collection('loan')->document('LA')->set($data);

        return '__SUCCESS__';
    }
}
