<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTerms extends Model
{
    use HasFactory;

    protected $fillable=['terms_percentage','no_of_duration','no_of_duration'];
}