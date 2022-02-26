<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Mail;
use Exception;

trait CommonTrait
{
	
	public function checkData($field,$value,$type) 
	{
		$status_code = 200;
		$message ="Valid ".$field;
		if(empty($type)){
			if($value==""){
				$message =$field." is Empty";
				$status_code = 100;	} } 
		else {
			if($type =="number-only") {
				if(!is_numeric($e))	{
					$message =$field." should contain only numbers";
					$status_code = 100;	}
			}
		}
		$data['filed'] = $field;
		$data['message'] = $message;
		$data['status_code'] = $status_code;
		return $data;
	}
	public function checkEmpty($value)
	{
		
		if(($value == "") || ($value == null)){
			return true;
		}else{
			return false;
		}
	}
   
   
}
?>