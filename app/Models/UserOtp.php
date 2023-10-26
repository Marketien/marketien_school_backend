<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Twilio\Rest\Client;

class UserOtp extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'otp',
        'expire_at',
        'status',
    ];

    public function sendSMS($reciever){
        $message = 'Login OTP is'.$this->otp;
        try {
            $account_id = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_numb = getenv("TWILIO_NUMB");
            $client = new Client($account_id, $auth_token);

            $client->messages->create($reciever,[
                'from'=> $twilio_numb,
                'body'=> $message,
            ]);
            info("SMS sent succesfully");
        } catch (\Exception $e) {
            info("ERROR : ".$e->getMessage());
        }
    }
}
