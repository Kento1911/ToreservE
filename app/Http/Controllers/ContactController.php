<?php

namespace App\Http\Controllers;

use App\Mail\SendTestMail;
use Illuminate\Http\Request;
use Mail;

/**
 * トップのcontact usの処理
 */
class ContactController extends Controller
{ 
    public function send(){

        $to = [
            [
                'email' => 'toreserve00@gmail.com', 
                'name' => 'Toreserve',
            ]
        ];
    
        Mail::to($to)->send(new SendTestMail());

        return redirect()->route('user.top');
    
        }
}
