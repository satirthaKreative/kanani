<?php

namespace App\Http\Controllers\Front\Others\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Others\ContactModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactFormQueryMail;

class ContactController extends Controller
{
    public function index(Request $request){
        $contactQuery = ContactModel::get();
        return view('front.pages.other-pages.contact',compact('contactQuery'));
    }

    public function send_mail_fx(Request $request){
        $contact_name = $request->input('contact_name');
        $contact_email = $request->input('contact_email');
        $contact_phone = $request->input('contact_phone');
        $contact_subject = $request->input('contact_subject');
        $contact_msg = $request->input('contact_msg');

        if($contact_name == "" || $contact_name == null){
            $request->session()->flash('error_msg', 'Enter your contact name');
        }else if($contact_email == "" || $contact_email == null){
            $request->session()->flash('error_msg', 'Enter your contact email');
        }else if($contact_phone == "" || $contact_phone == null){
            $request->session()->flash('error_msg', 'Enter your contact number');
        }else if($contact_subject == "" || $contact_subject == null){
            $request->session()->flash('error_msg', 'Enter your contact subject');
        }else if($contact_msg == "" || $contact_msg == null){
            $request->session()->flash('error_msg', 'Enter your contact message');
        }else{
            $details=[
                "reply_to_main_email" => strtolower($contact_email),
                "email"=>'satirtha.kreative@gmail.com',
                "title"=>"Contact Form Query",
                "subject"=>$contact_subject,
                "body"=>"<b>Name: </b>".$contact_name."<br /><b>Email : </b>".$contact_email."<br /><b>Phone Number: </b>".$contact_phone." <br /><b>Subject: </b>".$contact_subject."<br /><b>Query: </b>".$contact_msg,
            ];
            Mail::to('info@kananieducation.com')->send(new SendContactFormQueryMail($details));
            $request->session()->flash('success_msg', 'Your mail successfully sent. Admin will reach you soon.');
        }
        return redirect()->back();
    }
}