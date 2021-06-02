<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function contact(Request $request) {
        
        $this->validate($request,[
            'name'=>'required|string|min:3',
            'email'=>'required|email',
            'subject' => 'required',
            'message' => 'required'
         ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'msg' => trim($request->message)
        ];

        Mail::send('emails/contact', $data, function($message) {
            $message->to('anbua@cabcsgroup-india.com', 'ND-YTSCAM')->subject
                ('Enquiry From ND-YTSCAM');
            // $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->from('anbutechbee@gmail.com','ND-YTSCAM');
        });        
        return 'OK';        
    }

    public function planEnquiry(Request $request) {
        $this->validate($request,[
            'your_name'=>'required|string|min:3',
            'your_email'=>'required|email',
            'recipient_name' => 'required',
            'message_text' => 'required'
         ]);

        $data = [
            'name' => $request->your_name,
            'email' => $request->your_email,
            'subject' => $request->recipient_name,
            'msg' => trim($request->message_text)
        ];
        $subject = 'Plan Enquiry From ND-YTSCAM | '.$request->recipient_name;
        Mail::send('emails/contact', $data, function($message) use ($subject) {
            $message->to('anbua@cabcsgroup-india.com', 'ND-YTSCAM')->subject($subject);
            $message->from('anbutechbee@gmail.com','ND-YTSCAM');
        });
        return 'OK';
    }
}
