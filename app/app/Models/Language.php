<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;


class Language extends Model
{
    use HasFactory, Mediable;

    protected $table = 'language';

    protected $fillable = ['name','short_name','flag','is_default'];

}
