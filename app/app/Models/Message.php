<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "messages";
    protected $fillable = ['to_user','from_user','content'];

    public function fromUser()
    {
        return $this->belongsTo('App\Models\User', 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo('App\Models\User', 'to_user');
    }
}
