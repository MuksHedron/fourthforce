<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Mail;
use Exception;

trait EmailTrait
{
	
	public function sendmail($type) {
		
	try 
	{
		
		$data = $this->emailContent($type);		  
		Mail::send('mail', $data, function($message) use ($data) 
		{
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
		return true;
	}
	catch (Exception $ex) 
	{
		return false;;
	}
      
   }
   
   public function emailContent($type)
   {
   
		switch($type)
		{
		case('fileSave');
			$mail_from = config('global.admin_mail');
			$mail_from_name = "Admin";
			$to = array(config('global.my_mail'));
			$cc = array();
			$subject ="File Operation";
			$message = config('global.filesave_mail_content');;
			//$attachments = array(public_path().'\images\delete.png',public_path().'\images\edit.png');
			$attachments = array();
			$data = array('name'=>"Sir/Madam","msg"=>$message,"subject"=>$subject,'to'=>$to,'cc'=>$cc,'attachments'=>$attachments,'from'=>$mail_from,'from_name'=>$mail_from_name);
		    break;
			
		case('fileUpdate');
			$mail_from = "maruthu.xvalue@gmail.com";
			$mail_from_name = "Maruthupandi";
			$to = array('maruthu.xvalue@gmail.com');
			$cc = array();
			$subject ="File Operation";
			$message = "File Updated Successfully";
			$attachments = array(public_path().'\images\delete.png',public_path().'\images\edit.png');
			$data = array('name'=>"Sir/Madam","msg"=>$message,"subject"=>$subject,'to'=>$to,'cc'=>$cc,'attachments'=>$attachments,'from'=>$mail_from,'from_name'=>$mail_from_name);
            break;			
		}
		return $data;
   }
}
?>