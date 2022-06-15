<?php

namespace App\Http\Controllers;

use App\Mail\contactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('client.contact');
    }

  public function sendMail(Request $request)
  {
      $details = [
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message
      ];

      Mail::to('lghost6996@gmail.com')->send(new contactForm($details));
      if (count(Mail::failures()) > 0){
        return redirect()->route('contact')->withError('Hiện tại không thể gửi Mail. Vui lòng thử lại sau.');
      }
      return redirect()->back()->with('message-contact','Cảm ơn phản hồi của bạn.');
  }
}
