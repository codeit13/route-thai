<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Firestore;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected $database;
    protected $data;

    public function __construct($data)
    {   
        $this->firestore = app('firebase.firestore');
        $this->data = $data;
    }

    public function save_Loan_To_Firebase() {

        // $database = $this->firestore->database();
        // $value = $database->collection('samples/php/cities')->document($data->id)->set($data);

        $value = 'pass';

        return $value;
    }
}
