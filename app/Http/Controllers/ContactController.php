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
                'email' => 'torematch00@gmail.com', 
                'name' => 'Torematch',
            ]
        ];
    
        Mail::to($to)->send(new SendTestMail());

        return redirect()->route('user.top');
    
        }
}
