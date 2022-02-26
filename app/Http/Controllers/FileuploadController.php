<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileuploadRequest;
use App\Models\CaseResponse;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientState;
use App\Models\File;
use App\Models\Hub;
use App\Models\Lob;
use App\Models\Location;
use App\Models\LookUp;
use App\Models\Questions;
use App\Models\State;
use App\Models\SubLob;
use App\Models\Task;
use App\Models\TaskRole;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserClient;
use App\Models\UserFiles;
use App\Models\UserLoc;
use App\Models\UserRole;
use App\Models\Vendor;
use App\Models\Fileupload;
use App\Models\Batchupload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FileController;
use App\Traits\CommonTrait;
use Exception;

class FileuploadController extends Controller
{
	use CommonTrait;
    public function index(Request $request)
    {
		$fileCont = new FileController;
		$auth_user_id = Auth::user()->id;
        $role = $fileCont->roles($auth_user_id);
        $files = Batchupload::where('type','File')->orderBy('id','Desc')->get();
        return view('filesupload.index')->with(['files'=>$files,'role' => $role]);
    }
	public function create(Request $request)
    {
		$clients = Client::all()->sortBy("name");
        return view('filesupload.fileupload')->with(['clients' => $clients]);
    }
	public function show(Fileupload $fileupload,$id)
    {
		$fileCont = new FileController;
		$auth_user_id = Auth::user()->id;
        $role = $fileCont->roles($auth_user_id);
		$files = Fileupload::where('batch_id',$id)->get();
		
        return view('filesupload.batchfiles')->with(['files'=>$files,'role' => $role,'batchId' => $id,'files_json'=>json_encode($files)]);
    }
	public function uploadfile(Request $request, File $file)
    {        
	$uploaded_file = $request->file('uploaded_file');
	if ($uploaded_file) 
	{
		$filename = $uploaded_file->getClientOriginalName();
		$extension = $uploaded_file->getClientOriginalExtension(); //Get extension of uploaded uploaded_file
		$tempPath = $uploaded_file->getRealPath();
		$fileSize = $uploaded_file->getSize(); //Get size of uploaded file in bytes
		//Check for file extension and size
		$this->checkUploadedFileProperties($extension, $fileSize);
		//Where uploaded file will be stored on the server 
		//$location = 'uploads'; //Created an "uploads" folder for that
		// Upload file
		//$uploaded_file->move($location, $filename);
		// In case the uploaded file path is to be stored in the database 
		//$filepath = public_path($location . "/" . $filename);
		// Reading uploaded_file
		$uploaded_file = fopen($tempPath, "r");
		$importData_arr = array(); // Read through the file and store the contents as an array
		$i = 0;
		$datetime = date('Y-m-d h:i:s');
		//Read the contents of the uploaded file 
		$batch = new Batchupload();
		$count = Batchupload::where('type','File')->count();
		$batch->type = 'File';
		$batch->batch_number = 'FF-FU-'.preg_replace('/-|:/', null, date('Y-m-d')).'-'.($count+1);
		$batch->status = 1;
		$batch->created_on = $datetime;
		$batch->updated_on = $datetime;
		$batch->save();
		$filedataArr = [];
		while (($filedata = fgetcsv($uploaded_file, 1000, ",")) !== FALSE) 
		{
			$num = count($filedata);
			// Skip first row (Remove below comment if you want to skip the first row)
			if ($i == 0) 
			{
				$i++;
				continue;
				
			}
			
			
			
			$clientid = 0;
			$lobid = 0;
			$typeid = 0;
			$hub = 0;
			$hubid = 0;
			$stateid = 0;
			$cityid = 0;
			$locationid = 0;
			$relationid = 0;
			//$client = Client::where('name',$filedata[1])->first();
			$lob = lob::where('name',$filedata[1])->first();
			$sublob = sublob::where('name',$filedata[2])->first();
			$state = state::where('name',$filedata[3])->first();
			$city = city::where('name',$filedata[4])->first();
			$hub = hub::where('name',$filedata[5])->first();
			$location = location::where('name',$filedata[6])->first();
			$multiplelocation = $filedata[7];
			$agent_name = $filedata[8];
			$custref = lookup::where('type','reflabel')->where('tag',$filedata[9])->first();
			$policyno = $filedata[10];;
			$otherreflabel = lookup::where('type','otherreflabel')->where('tag',$filedata[11])->first();
			$otherref = $filedata[12];
			$name = $filedata[13];
			$receivedon = $filedata[14];
			$fathername = $filedata[15];
			$dob = $filedata[16];
			$nominee = $filedata[17];
			$relation = lookup::where('type','Relation')->where('tag',$filedata[18])->first();
			$address = $filedata[19];
			$pincode = $filedata[20];
			$mobile1 = $filedata[21];
			$mobile2 = $filedata[22];
			$email = $filedata[23];
			//print_r($mobile2);exit;
			//if($client){$clientid= $client->id;	}
			$clientid= $request->input('clientid');
			if($lob){$lobid= $lob->id;	}
			if($sublob){$typeid= $sublob->id;	}
			if($hub){$hubid= $hub->id;	}
			if($state){$stateid= $state->id;	}
			if($city){$cityid= $city->id;	}
			if($location){$locationid= $location->id;	}
			if($relation){$relationid= $relation->id;	}
			if($custref){$reflabel= $custref->id;	}
			if($otherreflabel){$otherreflabelid= $otherreflabel->id;	}
			
			array_push($filedataArr,array('batch_id'=>$batch->id,'clientname'=>$clientid,
			'clientid'=>$clientid,
			'lobid'=>$lobid,
			'lobname'=>$filedata[1],
			'typeid'=>$typeid,
			'typename'=>$filedata[2],
			'hubid'=>$hubid,
			'hubname'=>$filedata[5],
			'stateid'=>$stateid,
			'statename'=>$filedata[3],
			'cityid'=>$cityid,
			'cityname'=>$filedata[4],
			'locationid'=>$locationid,
			'locationname'=>$filedata[6],
			
			'name'=>$name,
			'dob'=>date('Y-m-d',strtotime($dob)),
			'fathername'=>$fathername,
			'address'=>$address,
			'pincode'=>$pincode,
			'mobile1'=>$mobile1,
			'mobile2'=>$mobile2?$mobile2:null,
			'email'=>$email,
			'receivedon'=>date('Y-m-d',strtotime($receivedon)),
			'nominee'=>$nominee,
			'relationid'=>$relationid,
			'relationname'=>$filedata[18],
			'agent'=>$agent_name,
			'reflabel'=>$reflabel,
			'reflabelname'=>$filedata[9],			
			'policyno'=>$policyno,
			'otherreflabel'=>$otherreflabelid,
			'otherreflabelname'=>$filedata[11],
			'otherref'=>$otherref,
			'ffref'=>'',
			'multipleloc'=>1,
			'filestatusid'=>47,
			'status'=>1,
			'upload_status'=>1,
			'dtcr'=>$datetime,
			'crby'=>2,
			'dtlm'=>$datetime,
			'lmby'=>2,
			));
							 
			
			$i++;
		}
		fclose($uploaded_file); //Close after reading
		

	}
	
	Fileupload::insert($filedataArr);
	
	//return view('filesupload.index');
	return redirect('fileupload')->withSuccess('Files Imported Successfully!!!');

	}
	public function checkUploadedFileProperties($extension, $fileSize)
    {
		$valid_extension = array("csv"); //Only want csv and excel files
		$maxFileSize = 2097152; // Uploaded file size limit is 2mb
		if (in_array(strtolower($extension), $valid_extension)) {
		if ($fileSize <= $maxFileSize) {
		} else {
		throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
		}
		} else {
		throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
		}
    }
	public function edit(Fileupload $fileupload)
    {
        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");
        $users = User::all()->sortBy("name");
        $locations = Location::all()->sortBy("name");
        $cities = City::where('stateid', $fileupload->stateid)->get();
        //$states = State::all()->sortBy("name");
        $states = ClientState::select('stateid')->distinct()->get()->sortBy("states.name");
        $hubs = Hub::all()->sortBy("name");
        $relations = LookUp::where('type', 'Relation')
            ->get()->sortBy("tag");
        $newcase = 1;
        $fileupload->receivedon = date('Y-m-d', strtotime($fileupload->receivedon));
        $fileupload->dob = date('Y-m-d', strtotime($fileupload->dob));
        $fileupload->lobid = $fileupload->lobid?$fileupload->lobid:0;
        $sublobs = SubLob::where('lobid', $fileupload->lobid)->get();
        $reflabel = LookUp::where('type', 'reflabel')->get()->sortBy("tag");
        $otherreflabel = LookUp::where('type', 'otherreflabel')->get()->sortBy("tag");
        $readonly = 'disabled';

        $response = "";

        return view('filesupload.edit')->with([
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'users' => $users,
            'hubs' => $hubs,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
            'file' => $fileupload,
            'relations' => $relations,
            'newcase' => $newcase,
            'readonly' => $readonly,
            'reflabels' => $reflabel,
            'otherreflabels' => $otherreflabel,
            'response' => $response,
        ]);
    }
	
	public function update(FileuploadRequest $request, Fileupload $fileupload)
    {
		//print_r($request->all());exit;
        $request->validated();

        $fileupload->clientid = $request->clientid;
        $fileupload->lobid = $request->lobid;
        $fileupload->typeid = $request->typeid;
        $fileupload->stateid = $request->stateid;
        $fileupload->cityid = $request->cityid;
        $fileupload->hubid = $request->hubid;
        $fileupload->locationid = $request->locationid;
        $fileupload->multipleloc = $request->multipleloc;
        $fileupload->agent = $request->agent;
        $fileupload->reflabel = $request->reflabel;
        $fileupload->policyno = $request->policyno;
        $fileupload->otherreflabel = $request->otherreflabel;
        $fileupload->otherref = $request->otherref;
        $fileupload->receivedon = $request->receivedon;
        $fileupload->name = $request->name;
        $fileupload->fathername = $request->fathername;
        $fileupload->dob = $request->dob;
        $fileupload->nominee = $request->nominee;
        $fileupload->relationid = $request->relationid;
        $fileupload->address = $request->address;
        $fileupload->pincode = $request->pincode;
        $fileupload->mobile1 = $request->mobile1;
        $fileupload->mobile2 = $request->mobile2;
        $fileupload->email = $request->email;

        $fileupload->dtlm = now();
        $fileupload->lmby = Auth::user()->id;
		$fileupload->upload_status = 2;
		$fileupload->error_msg = '';
        $update = $fileupload->save();

        $FileId = $fileupload->id;
        
        

        return redirect()->route('fileupload.index')
            ->withSuccess("The Case with id {$fileupload->id} was updated");
    }
	public function validateBatchfile(Request $request)
	{
		$batchId = $request->batchId;
		$files = Fileupload::where('batch_id',$batchId)->whereIn('upload_status',[1,3])->get();
		if($files)
		{
			
			$error_count = 0;
			foreach($files as $key=>$file)
			{
				$errors = [];
				$lob = lob::where('name',$file->lobname)->first();
				$sublob = sublob::where('name',$file->typename)->first();
				$state = state::where('name',$file->statename)->first();
				$city = city::where('name',$file->cityname)->first();
				$hub = hub::where('name',$file->hubname)->first();
				$location = location::where('name',$file->locationname)->first();
				$custref = lookup::where('type','reflabel')->where('tag',$file->reflabel)->first();
				$otherreflabel = lookup::where('type','otherreflabel')->where('tag',$file->otherreflabel)->first();
				$relation = lookup::where('type','Relation')->where('tag',$file->relationname)->first();
				//$type = $this->checkData('Sublob',$file->typename,'');
				if($file->lobid == 0)
				{					
					$lob = $this->checkEmpty($file->lobname);
					if($lob)
					{
						array_push($errors,'Lob is Empty');
					}
					else
					{
						if(!($lob))
						{
							array_push($errors,'Enter Valid Lob');
						}
					}
				}
				if($file->typeid == 0)
				{
					
					$type = $this->checkEmpty($file->typename);
					if($type)
					{
						array_push($errors,'Sub Lob is Empty');
					}
					if(!($sublob))
					{
						array_push($errors,'Enter Valid Sub Lob');
					}
				}
				if($file->hubid == 0)
				{
					
					$hubcheck = $this->checkEmpty($file->hubname);
					if($hubcheck)
					{
						array_push($errors,'Hub is Empty');
					}
					if(!($hub))
					{
						array_push($errors,'Enter Valid Hub');
					}
				}
				if($file->stateid == 0)
				{
					
					$statecheck = $this->checkEmpty($file->statename);
					if($statecheck)
					{
						array_push($errors,'State is Empty');
					}
					if(!($state))
					{
						array_push($errors,'Enter Valid State');
					}
				}
				if($file->cityid == 0)
				{
					
					$citycheck = $this->checkEmpty($file->cityname);
					if($citycheck)
					{
						array_push($errors,'City is Empty');
					}
					if(!($city))
					{
						array_push($errors,'Enter Valid City');
					}
				}
				if($file->locationid == 0)
				{
					
					$locationcheck = $this->checkEmpty($file->locationname);
					if($locationcheck)
					{
						array_push($errors,'Location is Empty');
					}
					if(!($location))
					{
						array_push($errors,'Enter Valid Location');
					}
				}
					
				$namecheck = $this->checkEmpty($file->name);
				if($namecheck)
				{
					array_push($errors,'Name is Empty');
				}
				$dobcheck = $this->checkEmpty($file->dob);
				if($dobcheck)
				{
					array_push($errors,'Dob is Empty');
				}
				$fathernamecheck = $this->checkEmpty($file->fathername);
				if($fathernamecheck)
				{
					array_push($errors,'Fathername is Empty');
				}
				$addresscheck = $this->checkEmpty($file->address);
				if($addresscheck)
				{
					array_push($errors,'Address is Empty');
				}
				$pincodecheck = $this->checkEmpty($file->pincode);
				if($pincodecheck)
				{
					array_push($errors,'Pincode is Empty');
				}
				
				
				$emailcheck = $this->checkEmpty($file->email);
				if($emailcheck)
				{
					array_push($errors,'Email is Empty');
				}			
				
				$policynocheck = $this->checkEmpty($file->policyno);
				if($policynocheck)
				{
					array_push($errors,'Policyno is Empty');
				}
				if($file->reflabel == 0)
				{
					
					$reflabelcheck = $this->checkEmpty($file->reflabelname);
					if($reflabelcheck)
					{
						array_push($errors,'Reflabel is Empty');
					}
					if(!($reflabel))
					{
						array_push($errors,'Enter Valid Reflabel');
					}
				}
				
				
				
				/*
				$nomineecheck = $this->checkEmpty($file->nominee);
				if($nomineecheck)
				{
					array_push($errors,'Nominee is Empty');
				}
				if($file->relationid == 0)
				{
					
					$relationcheck = $this->checkEmpty($file->relationname);
					if($relationcheck)
					{
						array_push($errors,'Relation is Empty');
					}
					if(!($relation))
					{
						array_push($errors,'Enter Valid Relation');
					}
				}
				$agentcheck = $this->checkEmpty($file->agent);
				if($agentcheck)
				{
					array_push($errors,'Agent is Empty');
				}				
				if($file->otherreflabel == 0)
				{
					
					$otherreflabelcheck = $this->checkEmpty($file->otherreflabelname);
					if($otherreflabelcheck)
					{
						array_push($errors,'Otherreflabel is Empty');
					}
					if(!($otherreflabel))
					{
						array_push($errors,'Enter Valid Otherreflabel');
					}
				}
				$otherrefcheck = $this->checkEmpty($file->otherref);
				if($otherrefcheck)
				{
					array_push($errors,'Otherref is Empty');
				}				
				$mobile1check = $this->checkEmpty($file->mobile1);
				if($mobile1check)
				{
					array_push($errors,'mobile1 is Empty');
				}
				$mobile2check = $this->checkEmpty($file->mobile2);
				if($mobile2check)
				{
					array_push($errors,'mobile2 is Empty');
				}
				$emailcheck = $this->checkEmpty($file->email);
				if($emailcheck)
				{
					array_push($errors,'Email is Empty');
				}
				*/
				$fileupload = Fileupload::find($file->id);
				if(count($errors) > 0)
				{
				$error_count++;
                $fileupload->upload_status = 3;
                $fileupload->error_msg = implode(',',$errors);;
				}
				else{
				$fileupload->upload_status = 2;	
				$fileupload->error_msg = '';	
				}
				$fileupload->save();
					
			}
			$batchupload = Batchupload::find($batchId);
			if($error_count > 0)
			{
				$batchupload->status = 3;
			}else {
			$batchupload->status = 2;}
			$batchupload->save();
			
			$data['status_code'] = 200;
			$data['message'] = 'Files Validated Successfully';
		}
		else
		{
			$data['status_code'] = 100;
			$data['message'] = 'No Records to validate';
		}
		//$res = $this->checkData('Lob','Life Insurance','');
		
		
		echo json_encode($data);exit;
	}
	
	public function importBatchfile(Request $request)
	{
		$batchId = $request->batchId;
		$count = File::count();
		
		try{
		$fileupload = Fileupload::where('batch_id',$batchId)->whereIn('upload_status',[2])->get()->map(function(Fileupload $fileupload,$key) use ($count) 
		{
			$lob = lob::where('id', $fileupload->lobid)->first();
			$sublob = Sublob::where('id', $fileupload->typeid)->first();
			$ffref = "ff-" . $lob->shortname . "-" . $sublob->shortname . "-" . ($count+$key + 1);
			return [
				'clientid' => $fileupload->clientid,
				'typeid' => $fileupload->typeid,
				'hubid' => $fileupload->hubid,
				'stateid' => $fileupload->stateid,
				'cityid' => $fileupload->cityid,
				'locationid' => $fileupload->locationid,
				'name' => $fileupload->name,
				'dob' => $fileupload->dob,
				'fathername' => $fileupload->fathername,
				'address' => $fileupload->address,
				'pincode' => $fileupload->pincode,
				'mobile1' => $fileupload->mobile1,
				'mobile2' => $fileupload->mobile2,
				'email' => $fileupload->email,
				'receivedon' => $fileupload->receivedon,
				'nominee' => $fileupload->nominee,
				'relationid' => $fileupload->relationid,
				'agent' => $fileupload->agent,
				'reflabel' => $fileupload->reflabel,
				'policyno' => $fileupload->policyno,
				'otherreflabel' => $fileupload->otherreflabel,
				'otherref' => $fileupload->otherref,
				'ffref' => $ffref,
				'multipleloc' => $fileupload->multipleloc,
				'filestatusid' => $fileupload->filestatusid,
				'status' => $fileupload->status,
				'dtcr' => date('Y-m-d h:i:s'),
				'crby' => Auth::user()->id,
				'dtlm' => date('Y-m-d h:i:s'),
				'lmby' => Auth::user()->id,
			];
		})->ToArray();//print_r($fileupload);exit;
		$batchupload = File::insert($fileupload);
		if($batchupload)
		{
			if($request->type == "All")
			{
				Fileupload::where('batch_id',$batchId)->delete();
				Batchupload::where('id',$batchId)->delete();
			}
			else
			{
				Fileupload::where('batch_id',$batchId)->whereIn('upload_status',[2])->delete();
				$filecount = Fileupload::where('batch_id',$batchId)->count();
				if($filecount <= 0){
				Batchupload::where('id',$batchId)->delete();}
			}
			$data['status_code'] = 200;
			$data['message'] = 'Files imported Successfully';
		}
		else
		{
			$data['status_code'] = 100;
			$data['message'] = 'Error in Files import';
		}
		}catch(Exception $e){
			$data['status_code'] = 100;
			$data['message'] = $e->getMessage();
		}
		echo json_encode($data);exit;
		
	}
	
}
