<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Traits\EmailTrait;

class FileController extends Controller
{
	use EmailTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		
        $q = null;
        $filter = "";
        session()->forget('indexReassign');

        if ($request->has('q') != null) {
            $q = $request->query('q');
        }

        if ($request->query('filter') != null) {
            $q = $request->query('filter');
        }

        $auth_user_id = Auth::user()->id;

        $role = $this->roles($auth_user_id);

        $status = $this->actionStatus($role);

        if (empty($status)) {
            $status = [0, 0];
        }
        if ($role == "Administrator" || $role == "CRM") {

            if ($request->query('filter') != null) {
                $files = $this->indexFilter($q);
            } else {
                $files = $this->indexQueryFilter($q);
            }
        } else if ($role == "Assignor") {

            $status = $this->actionStatus($role);

            if ($q == null) {
                $q = $status[0];
            }

            $files = $this->indexFilter($q);

            $location = "";
            $users = $this->fieldusers($location);


            return view('files.index')->with([
                'files' => $files,
                'users' => $users,
                'role' => $role
            ]);
        } else if ($role == "CVO" || $role == "TVO" || $role == "Vendor") {
            $files = $this->indexUserFieldFilter($auth_user_id, $status, $q);
        } else {

            $files = $this->indexUserFilter($auth_user_id, $status, $q);
        }

        $filestatuses = LookUp::where('type', 'File Status')->get();

        return view('files.index')->with([
            'files' => $files,
            'filter' => $filter,
            'filestatuses' => $filestatuses,
            'role' => $role
        ]);
    }



    public function indexReassign(Request $request)
    {


        session(['indexReassign' => 1]);
        $q = null;
        $filter = "";

        $auth_user_id = Auth::user()->id;



        $role = $this->roles($auth_user_id);


        if ($request->has('q') != null) {
            $q = $request->query('q');
        }

        if ($request->query('filter') != null) {
            $q = $request->query('filter');
        }

        $files = File::whereIn('filestatusid', [64, 67])->paginate(10);


        $filestatuses = LookUp::where('type', 'File Status')->get();


        return view('files.reassignfile')->with([
            'files' => $files,
            'filter' => $filter,
            'filestatuses' => $filestatuses,
            'role' => $role
        ]);
    }


    public function indexQueryFilter($q)
    {
        $files = File::SearchFiles($q)->paginate(10);
        return $files;
    }

    public function indexFilter($q)
    {
        $files = File::where('filestatusid', $q)->paginate(10);
        return $files;
    }

    public function roles($auth_user_id)
    {
        $auth_user_role = UserRole::where('usersid', $auth_user_id)->first();

        if (empty($auth_user_role)) {
            return redirect('/home')->withErrors('You have not map with user role. Please contact the Admin');
        }

        return $auth_user_role->roles->name;
    }





    public function indexUserFilter($userid, $filestatuses, $q)
    {
        $fileid = UserFiles::select(['fileid'])
            ->where('userid', $userid)
            ->get();
        $files = File::whereIn('id', $fileid)
            ->where('filestatusid', $filestatuses[0])
            ->SearchFiles($q)
            ->paginate(10);

        return $files;
    }

    public function indexUserFieldFilter($userid, $filestatuses, $q)
    {
        // $fileid = UserFiles::select(['fileid'])
        //     ->where('userid', $userid)
        //     ->get();
        // $files = File::whereIn('id', $fileid)
        //     ->where('filestatusid', $filestatuses[0])
        //     ->SearchFiles($q)
        //     ->paginate(10);


        $files = File::select(['file.*', 'task.name as taskname', 'task.id as taskid'])->distinct()
            ->join('userfiles', 'userfiles.fileid', '=', 'file.id')
            ->join("taskuser", function ($join) {
                $join->on("taskuser.userid", "=", "userfiles.userid")
                    ->on("taskuser.fileid", "=", "file.id");
            })
            ->join('task', 'task.id', '=', 'taskuser.taskid')
            ->where('filestatusid', $filestatuses[0])
            ->where('userfiles.userid', $userid)
            ->SearchFiles($q)
            ->paginate(10);


        return $files;
    }

    public function fieldusers($location)
    {
        $users = UserLoc::join('usersrole', 'userloc.usersid', '=', 'usersrole.usersid')
            ->whereIn('usersrole.roleid', [5, 6, 7])
            ->where('userloc.locationid', $location)->get();

        return $users;
    }
    public function fieldusers_vendor($location, $vendor_id)
    {
        $users = UserLoc::join('usersrole', 'userloc.usersid', '=', 'usersrole.usersid')
            ->whereIn('usersrole.roleid', [5, 6])
            ->where('userloc.locationid', $location)->get();

        return $users;
    }


    public function processorusers($clientid)
    {
        // $users = UserLoc::join('usersrole', 'userloc.usersid', '=', 'usersrole.usersid')
        //     ->whereIn('usersrole.roleid', [3])
        //     ->where('userloc.locationid', $location)->get();
        // return $users;

        $users = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 3)
            ->where('userclient.clientid', $clientid)
            ->distinct(['userclient.userid'])
            ->get();
        return $users;
    }
    public function qcusers($clientid)
    {
        // $users = UserLoc::join('usersrole', 'userloc.usersid', '=', 'usersrole.usersid')
        //     ->whereIn('usersrole.roleid', [4])
        //     ->where('userloc.locationid', $location)->get();
        // return $users;

        $users = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 4)
            ->where('userclient.clientid', $clientid)
            ->distinct(['userclient.userid'])
            ->get();

        return $users;
    }




    public function lockFile($fileid, $userid)
    {
        $userfile = UserFiles::where('fileid', [$fileid])
            ->where('status', 1)
            ->get();

        if (!empty($userfile[0]->fileid)) {
            return 1;
        }


        $userfile = UserFiles::where('fileid', [$fileid])
            ->where('userid', $userid)
            ->first();

        $userfile->status = 1;
        $userfile->save();

        return 0;
    }


    public function lockReleaseFile($fileid, $userid)
    {
        $userfile = UserFiles::where('fileid', [$fileid])
            ->where('userid', $userid)
            ->first();

        $userfile->status = 0;
        $userfile->save();
    }

    public function returnStatus($roleName)
    {
        $status = "";

        switch (trim($roleName)) {
            case ('CVO'):
                $status = "51";
                return $status;
                break;
            case ('TVO'):
                $status = "51";
                return $status;
                break;
            case ('Vendor'):
                $status = "51";
                return $status;
                break;
            case ('Processor'):
                $status = "64";
                return $status;
                break;
            case ('QC'):
                $status = "67";
                return $status;
                break;
            default:
        }
    }

    public function actionStatus($roleName)
    {
        $currentstatus = "";
        $newstatus = "";

        switch (trim($roleName)) {
            case ('CRM'):
                $currentstatus = "47";
                $newstatus = "47";
                return [$currentstatus, $newstatus];
                break;
            case ('Assignor'):
                $currentstatus = "47";
                $newstatus = "50";
                return [$currentstatus, $newstatus];
                break;
            case ('CVO'):
                $currentstatus = "50";
                $newstatus = "61";
                return [$currentstatus, $newstatus];
                break;
            case ('TVO'):
                $currentstatus = "50";
                $newstatus = "61";
                return [$currentstatus, $newstatus];
                break;
            case ('Vendor'):
                $currentstatus = "50";
                $newstatus = "61";
                return [$currentstatus, $newstatus];
                break;
            case ('Processor'):
                $currentstatus = "61";
                $newstatus = "63";
                return [$currentstatus, $newstatus];
                break;
            case ('QC'):
                $currentstatus = "63";
                $newstatus = "66";
                return [$currentstatus, $newstatus];
                break;
                // case ('SPOC'):
                //     $currentstatus = "49";
                //     $newstatus = "50";
                //     return [$currentstatus, $newstatus];
                //     break;
            case ('Administrator'):
                $currentstatus = "0";
                $newstatus = "0";
                break;
            default:
        }
    }


    public function createcaseclient()
    {
        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");
        $sublobs = SubLob::all()->sortBy("type");
        $locations = Location::all()->sortBy("name");
        $cities = City::all()->sortBy("name");
        $states = State::all()->sortBy("name");
        $hubs = Hub::all()->sortBy("name");


        return view('files.createcaseclient')->with([
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'hubs' => $hubs,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
        ]);
    }

    public function createcase(Request $request, File $file)
    {
        $file->clientid = $request->clientid;
        $file->hubid = $request->hubid;
        $file->typeid = $request->typeid;
        $file->stateid = $request->stateid;
        $file->cityid = $request->cityid;
        $file->locationid = $request->locationid;

        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");
        $sublobs = SubLob::all()->sortBy("type");
        $locations = Location::all()->sortBy("name");
        $cities = City::all()->sortBy("name");
        $states = State::all()->sortBy("name");
        $hubs = Hub::all()->sortBy("name");
        $relations = LookUp::where('type', 'Relation')
            ->get()->sortBy("tag");
        $newcase = 0;
        return view('files.createcase')->with([
            'file' => $file,
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'hubs' => $hubs,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
            'relations' => $relations,
            'newcase' => $newcase,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");
        $sublobs = SubLob::all()->sortBy("type");
        $users = User::all()->sortBy("name");
        $locations = Location::all()->sortBy("name");
        $cities = City::all()->sortBy("name");
        $states = ClientState::select('stateid')->distinct()->get()->sortBy("states.name");
        $hubs = Hub::all()->sortBy("name");
        $relations = LookUp::where('type', 'Relation')
            ->get()->sortBy("tag");
        $reflabel = LookUp::where('type', 'reflabel')->get()->sortBy("tag");
        $otherreflabel = LookUp::where('type', 'otherreflabel')->get()->sortBy("tag");
        $newcase = 0;
        $readonly = 'readonly';
        return view('files.create')->with([
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'hubs' => $hubs,
            'relations' => $relations,
            'users' => $users,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
            'newcase' => $newcase,
            'readonly' => $readonly,
            'reflabels' => $reflabel,
            'otherreflabels' => $otherreflabel,
        ]);
    }

    public function storecase(FileRequest $filerequest, File $file, Request $request)
    {

        $file->fill($filerequest->all());

        $file->filestatusid = 47;
        $file->status = 1;
        $file->dtcr = now();
        $file->crby = Auth::user()->id;
        $file->dtlm = now();
        $file->lmby = Auth::user()->id;
        $file->save();


        $processor = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 3)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();

        $qc = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 4)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();

        if (!empty($processor->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $processor->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }

        if (!empty($qc->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $qc->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }

        return redirect()
            ->route('files.index')
            ->withSuccess("New Case with id {$file->id} was created");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request, File $file)
    {
        /*
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
	//Read the contents of the uploaded file 
	while (($filedata = fgetcsv($uploaded_file, 1000, ",")) !== FALSE) 
	{
		$num = count($filedata);
		// Skip first row (Remove below comment if you want to skip the first row)
		if ($i == 0) 
		{
			$i++;
			continue;
		}
		$filedataArr = [];
		//for ($c = 0; $c < $num; $c++) { 
		$client = Client::where('name',$filedata[1])->first();
		$lob = lob::where('name',$filedata[2])->first();
		$sublob = sublob::where('name',$filedata[3])->first();
		$state = state::where('name',$filedata[4])->first();
		$city = city::where('name',$filedata[5])->first();
		$hub = hub::where('name',$filedata[6])->first();
		$location = location::where('name',$filedata[7])->first();
		$multiplelocation = $filedata[8];
		$agent_name = $filedata[9];
		$custref = lookup::where('type','reflabel')->where('tag',$filedata[10])->first();
		$policyno = $filedata[11];;
		$otherreflabel = lookup::where('type','otherreflabel')->where('tag',$filedata[12])->first();
		$otherref = $filedata[13];
		$receivedon = $filedata[14];
		$name = $filedata[15];
		$fathername = $filedata[16];
		$dob = $filedata[17];
		$nominee = $filedata[18];
		$relation = lookup::where('type','Relation')->where('tag',$filedata[19])->first();
		$address = $filedata[20];
		$pincode = $filedata[21];
		$mobile1 = $filedata[22];
		$mobile2 = $filedata[23];
		$email = $filedata[24];
	    
	         if($client)
			 {
				 $client_id = $client->id;
				 
				 if($lob)
				 {
					$filedataArr[]=array('clientid',$client_id,'lobid'=>$lob->id); 
				 }
			 }
			 
			//$importData_arr[$i][] = $filedata[$c];
		//}
		$i++;
	}
	fclose($uploaded_file); //Close after reading
	

}	
*/

        $request->validated();

        $file->fill($request->except('lobid', 'getFileId', 'getResponse', 'getauthid'));
        // $hubloc = HubLoc::where('locationid', $file->locationid)->first();

        // if (empty($hubloc)) {
        //     return redirect('/home')->withErrors('Your location is not map with hub. Please contact the Admin');
        // }


        $count = File::count();
        $lob = lob::where('id', $request->lobid)->first();
        $sublob = Sublob::where('id', $request->typeid)->first();
        $ffref = "ff-" . $lob->shortname . "-" . $sublob->shortname . "-" . ($count + 1);

        $file->filestatusid = 47;
        // $file->hubid = $hubloc->hubid;
        $file->status = 1;
        $file->dtcr = now();
        $file->crby = Auth::user()->id;
        $file->dtlm = now();
        $file->lmby = Auth::user()->id;
        $file->ffref = $ffref;
        $file->save();


        $processor = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 3)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();
        // ->get(['userclient.userid']);

        // if (empty($processor->userid)) {
        //     return redirect('/home')->withErrors('Your Processor is not map with client. Please contact the Admin');
        // }

        if (!empty($processor->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $processor->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }

        $qc = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 4)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();
        // ->get(['userclient.userid']);

        // if (empty($qc->userid)) {
        //     return redirect('/home')->withErrors('Your QC is not map with client. Please contact the Admin');
        // }

        if (!empty($qc->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $qc->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }
		$this->sendmail('fileSave');

        return redirect()
            ->route('files.index')
            ->withSuccess("New Case with id {$file->id} was created");
    }
    // public function checkUploadedFileProperties($extension, $fileSize)
    // {
    // $valid_extension = array("csv"); //Only want csv and excel files
    // $maxFileSize = 2097152; // Uploaded file size limit is 2mb
    // if (in_array(strtolower($extension), $valid_extension)) {
    // if ($fileSize <= $maxFileSize) {
    // } else {
    // throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
    // }
    // } else {
    // throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
    // }
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");

        $users = User::all()->sortBy("name");
        $locations = Location::all()->sortBy("name");
        $cities = City::where('stateid', $file->stateid)->get();
        //$states = State::all()->sortBy("name");
        $states = ClientState::select('stateid')->distinct()->get()->sortBy("states.name");
        $hubs = Hub::all()->sortBy("name");
        $relations = LookUp::where('type', 'Relation')
            ->get()->sortBy("tag");
        $newcase = 1;
        $file->receivedon = date('Y-m-d', strtotime($file->receivedon));
        $file->dob = date('Y-m-d', strtotime($file->dob));
        $file->lobid = $file->sublobs->lobid;
        $sublobs = SubLob::where('lobid', $file->lobid)->get();
        $reflabel = LookUp::where('type', 'reflabel')->get()->sortBy("tag");
        $otherreflabel = LookUp::where('type', 'otherreflabel')->get()->sortBy("tag");
        $readonly = 'disabled';

        $response = "";

        return view('files.edit')->with([
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'users' => $users,
            'hubs' => $hubs,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
            'file' => $file,
            'relations' => $relations,
            'newcase' => $newcase,
            'readonly' => $readonly,
            'reflabels' => $reflabel,
            'otherreflabels' => $otherreflabel,
            'response' => $response,
        ]);
    }

    public function assignfile(File $file, Request $request)
    {
        $fileid = $request->id;

        $file = File::find($fileid);
        $taskassigned_list = Taskuser::where('fileid', $file->id)->get();
        // $tasks = TaskRole::select('taskid')
        // ->whereIn('roleid', [5, 6, 7])->groupBy('taskid')->get();

        $tasks = Task::select('task.id', 'task.name')
            ->join('taskrole', 'task.id', '=', 'taskrole.taskid')
            ->whereIn('taskrole.roleid', [5, 6, 7])
            ->where('task.sublobid', $file->typeid)
            ->groupBy('task.id', 'task.name')
            ->get();


        //print_r($tasks);exit;
        if (Auth::user()->vendorid == "0" || Auth::user()->vendorid == "") {
            if ($file->filestatusid == 47 || $file->filestatusid == 51) {
                $users = $this->fieldusers($file->locationid);
                $vendors = Vendor::all();
            } else if ($file->filestatusid == 61 || $file->filestatusid == 62 || $file->filestatusid == 64) {
                $users = $this->processorusers($file->clientid);
            } else {
                $users = $this->qcusers($file->clientid);
            }
        } else {
            $users = $this->fieldusers_vendor($file->locationid, Auth::user()->vendorid);
        }


        if (Auth::user()->vendorid == "0" || Auth::user()->vendorid == "") {
            return view('files.assignfile')->with([
                'users' => $users,
                // 'vendors' => $vendors,
                'file' => $file,
                'taskassigned_list' => $taskassigned_list,
                'tasks' => $tasks,
            ]);
        } else {
            return view('files.vendor_assignfile')->with([
                'users' => $users,
                'file' => $file,
                'taskassigned_list' => $taskassigned_list,
                'tasks' => $tasks,
            ]);
        }
    }

    public function assigntasktofile(Request $request)
    {
        $taskassigned_check = TaskUser::where('fileid', $request->fileid)->where('userid', $request->userid)->where('taskid', $request->taskid)->count();
        if ($taskassigned_check > 0) {
            $result = array('status_code' => 100, 'status' => 'error', 'message' => 'Task Already assigned to this user');
        } else {
            $date = date('Y-m-d h:i:s');
            $assignedby = Auth::user()->id;
            $Taskuser = new TaskUser();
            $Taskuser->fileid = $request->fileid;
            $Taskuser->taskid = $request->taskid;
            $Taskuser->userid = $request->userid;
            $Taskuser->status = 0;
            $Taskuser->dtcr = $date;
            $Taskuser->dtlm = $date;
            $Taskuser->crby = $assignedby;
            $Taskuser->lmby = $assignedby;

            $tasksave = $Taskuser->save();

            if ($tasksave) {
                $userfile = new UserFiles();
                $userfile->fileid = $request->fileid;
                $userfile->userid = $request->userid;
                $userfile->taskid = $request->taskid;
                $userfile->status = 0;
                $userfile->dtcr = now();
                $userfile->crby = Auth::user()->id;
                $userfile->dtlm = now();
                $userfile->lmby = Auth::user()->id;
                $userfile->save();

                $fileid = $request->fileid;

                $file = File::find($fileid);

                $tasks = Task::select('task.id', 'task.name')
                    ->join('taskrole', 'task.id', '=', 'taskrole.taskid')
                    ->whereIn('taskrole.roleid', [5, 6, 7])
                    ->where('task.sublobid', $file->typeid)
                    ->groupBy('task.id')
                    ->get();

                $userfiles = UserFiles::where('fileid', $request->fileid)
                    ->where('userid', $request->userid)
                    ->where('taskid', $request->taskid)
                    ->where('status', 0)
                    ->get();

                if ($userfiles->count() >= $tasks->count()) {
                    $file->filestatusid = 50;
                    $file->save();
                }
            }

            if ($tasksave) {
                $result = array('status_code' => 200, 'status' => 'success', 'message' => 'Task assigned to this user Successfully');
            } else {
                $result = array('status_code' => 100, 'status' => 'error', 'message' => 'Error in task save');
            }
        }
        //print_r($request->all());exit;
        echo json_encode($result);
        //return response()->json($result);
    }
    public function delete_assigntasktofile(Request $request)
    {
        $taskassigned_rem = Taskuser::where('id', $request->id)->delete();
        if ($taskassigned_rem > 0) {
            $result = array('status_code' => 200, 'status' => 'success', 'message' => 'Task removed successfully');
        } else {
            $result = array('status_code' => 100, 'status' => 'error', 'message' => 'Error in task remove');
        }
        //print_r($request->all());exit;
        echo json_encode($result);
        //return response()->json($result);
    }

    public function updateassignfile(Request $request)
    {
        $filtervendor = $request->input('filtervendor');
        $filteruser = $request->input('filteruser');

        $fileid = $request->input('getFileId');

        $file = File::find($fileid);


        if (!empty($filtervendor)) {
            $file->filestatusid = 70;
            $file->save();
            return redirect()
                ->route('files.index')
                ->withSuccess("The Case with id {$fileid} was assigned  to Vendor");
        }



        $userfile = new UserFiles();
        $userfile->fileid = $fileid;
        $userfile->userid = $filteruser;
        $userfile->status = 0;
        $userfile->dtcr = now();
        $userfile->crby = Auth::user()->id;
        $userfile->dtlm = now();
        $userfile->lmby = Auth::user()->id;
        $userfile->save();

        $file = File::find($fileid);


        if ($file->filestatusid == 47 || $file->filestatusid == 51) {
            $file->filestatusid = 50;
        } else if ($file->filestatusid == 61 || $file->filestatusid == 62 || $file->filestatusid == 64) {
            $file->filestatusid = 61;
        } else {
            $file->filestatusid = 63;
        }

        $file->save();

        $indexReassign =  session()->get('indexReassign');

        if ($indexReassign == 1) {
            session()->forget('indexReassign');
            return redirect()
                ->route('files.reassignfile')
                ->withSuccess("The Case with id {$fileid} was Re-Assigned  to {$userfile->users->name}");
        } else {
            return redirect()
                ->route('files.index')
                ->withSuccess("The Case with id {$fileid} was assigned  to {$userfile->users->name}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(FileRequest $request, File $file)
    {
		//print_r($request->all());exit;
        $request->validated();

        $responseArray = json_decode($request->input("getResponse"), true);

        // $file->fill($request->all());
        // $file->fill($request->except('lobid', 'clientid', 'typeid', 'stateid', 'cityid', 'getFileId', 'getResponse', 'getauthid'));

        $file->clientid = $request->clientid;
        // $file->lobid = $request->lobid;
        $file->typeid = $request->typeid;
        $file->stateid = $request->stateid;
        $file->cityid = $request->cityid;
        $file->hubid = $request->hubid;
        $file->locationid = $request->locationid;
        $file->multipleloc = $request->multipleloc;
        $file->agent = $request->agent;
        $file->reflabel = $request->reflabel;
        $file->policyno = $request->policyno;
        $file->otherreflabel = $request->otherreflabel;
        $file->otherref = $request->otherref;
        $file->receivedon = $request->receivedon;
        $file->name = $request->name;
        $file->fathername = $request->fathername;
        $file->dob = $request->dob;
        $file->nominee = $request->nominee;
        $file->relationid = $request->relationid;
        $file->address = $request->address;
        $file->pincode = $request->pincode;
        $file->mobile1 = $request->mobile1;
        $file->mobile2 = $request->mobile2;
        $file->email = $request->email;

        $file->dtlm = now();
        $file->lmby = Auth::user()->id;
        $file->save();

        $FileId = $file->id;

        if (!empty($responseArray)) {

            foreach ($responseArray as  $key) {
                foreach ($key as $value) {

                    if (isset($value["response"])) {

                        $caseresp = new CaseResponse();

                        $questions = Questions::where('questionid', $value["questionid"])
                            ->where('taskid', $value["taskid"])
                            ->orderBy('questionid')->first();

                        $caseresp->caseid = $FileId;
                        $caseresp->questionid = $questions->id;
                        $caseresp->taskid = $questions->taskid;
                        $caseresp->response = $value["response"];
                        $caseresp->status = 1;
                        $caseresp->crby = Auth::user()->id;
                        $caseresp->dtcr = now();
                        $caseresp->dtlm = now();
                        $caseresp->lmby =  Auth::user()->id;
                        $caseresp->save();
                    }
                }
            }

            /*$questions = (new QuestionsController)->questionsInital($FileId, $questions->taskid);

            foreach ($questions as $question) {
                if ($question->initial !== null && trim($question->initial) !== "") {

                    $assginquestion = Questions::where('questionid', $question->initial)
                        ->where('taskid', $question->taskid)
                        ->orderBy('questionid')->first();


                    $casereponse = CaseResponse::where('questionid', $assginquestion->id)
                        ->where('taskid', $question->taskid)
                        ->where('caseid', $FileId)
                        ->where('status', 1)->first();

                    if (!empty($casereponse->response)) {
                        $caseresp = new CaseResponse();
                        $caseresp->caseid = $FileId;
                        $caseresp->questionid = $question->id;
                        $caseresp->taskid = $question->taskid;
                        $caseresp->response = $casereponse->response;
                        $caseresp->status = 1;
                        $caseresp->crby = Auth::user()->id;
                        $caseresp->dtcr = now();
                        $caseresp->dtlm = now();
                        $caseresp->lmby =  Auth::user()->id;
                        $caseresp->save();

                        $casereponseExists = CaseResponse::where('questionid', $question->id)
                            ->where('taskid', $question->taskid)
                            ->where('caseid', $FileId)
                            ->where('response', $casereponse->response)
                            ->where('status', 1)->first();
                        if ($casereponseExists) {
                            CaseResponse::where('id', $casereponseExists->id)->update(['status' => 0]);
                        }
                    }
                }
            }*/
        }

        return redirect()
            ->route('files.index')
            ->withSuccess("The Case with id {$file->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
