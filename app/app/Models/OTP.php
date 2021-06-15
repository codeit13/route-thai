<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Config; 
use App\Http\Traits\Uuids;

class OTP extends Model
{
    
    use Uuids;

    protected $table = 'otp';
    protected $dates = ['created_at', 'updated_at'];

    public function removeExpiredTokens()
    {
        OTP::where('expire_at', '<=', Carbon::now())->delete();

        return true;
    }

    public function generate($to)
    {
        $this->removeExpiredTokens();
        do
        { 
            $otp = str_pad(rand(100000, 999999), 6);
        }
        while(OTP::whereValue($otp)->exists());
        $this->id = generate_unique_id(32);
        $this->value = $otp;
        $this->to = $to;
        $this->expire_at = Carbon::now()->addMinutes(Config::get('otp.expiry'));
        $this->save();

        return $this;
    }

    public function getTrialsCount($channel, $to)
    {
        return OTP::whereChannel($channel)->whereTo($to)->count();
    }
}
