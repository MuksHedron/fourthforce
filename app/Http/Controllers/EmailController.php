<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Mail;

class EmailController extends Controller
{
    //
	public function sendmail($data) {
		
      Mail::send('mail', $data, function($message) use ($data) {
         $message->from($data['from'],$data['from_name']);
		 $message->to($data['to']);
		 if(!empty($data['cc'])){
		 $message->cc($data['cc']);}
		 $message->subject($data['subject']);
		 if(!empty($data['attachments'])){
		 foreach($data['attachments'] as $attachment){
         $message->attach($attachment);
		 }}
      });
      
   }
}
