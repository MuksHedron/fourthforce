<?php

namespace App\Http\Controllers;

use App\Models\CaseResponse;
use App\Models\File;
use App\Models\Questions;
use App\Models\Task;
use App\Models\UserClient;
use App\Models\UserFiles;
use Facade\FlareClient\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CaseResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = null;

        if ($request->has('q')) $q = $request->query('q');

        $caseresponses = CaseResponse::SearchCaseResponses($q)
            ->paginate(10);

        return view('caseresponses.index')->with([
            'caseresponses' => $caseresponses
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $responseArray =  session()->get('responseArray');
        $fileId = $request->input("getFileId");

        // $latitude = $request->input("latitude");

        // $longitude = $request->input("longitude");

        $isSave = false;
        $taskid = "";

        foreach ($responseArray as  $key) {
            foreach ($key as $value) {

                if (isset($value["response"])) {

                    $caseresponses = new CaseResponse();
                    $taskid = $value["taskid"];
                    $questions = Questions::where('questionid', $value["questionid"])
                        ->where('taskid', $value["taskid"])
                        ->orderBy('questionid')->first();

                    $caseresponses->caseid = $fileId;
                    $caseresponses->taskid = $questions->taskid;
                    $caseresponses->questionid = $questions->id;
                    $caseresponses->response = $value["response"];
                    // $caseresponses->response = $latitude;
                    // $caseresponses->response = $longitude;
                    $caseresponses->status = 1;
                    $caseresponses->crby = 1;
                    $caseresponses->dtcr = now();
                    $caseresponses->lmby = 1;
                    $caseresponses->dtlm = now();
                    $caseresponses = caseresponse::create($caseresponses->toArray());

                    if (!empty($caseresponses)) {
                        $isSave = true;
                    }
                }
            }
        }

        if ($isSave) {

            $userfile = UserFiles::where('fileid', $fileId)
                ->where('userid', Auth::user()->id)
                ->where('taskid',  $taskid)
                ->first();
            $userfile->status = 1;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();

            $file = File::findOrFail($fileId);

            $taskscount = Task::select('task.id', 'task.name')
                ->join('taskrole', 'task.id', '=', 'taskrole.taskid')
                ->whereIn('taskrole.roleid', [5, 6, 7])
                ->where('task.sublobid', $file->typeid)
                ->groupBy('task.id')
                ->get();


            $userfilecount = UserFiles::where('fileid', $fileId)
                ->where('userid', Auth::user()->id)
                ->where('taskid',  $taskid)
                ->where('status', 1)
                ->get();


            if ($taskscount->count() <= $userfilecount->count()) {

                $processor = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
                    ->where('usersrole.roleid', 3)
                    ->where('userclient.clientid', $file->clientid)
                    ->distinct(['userclient.userid'])
                    ->first();

                if (!empty($processor->userid)) {
                    $file->filestatusid = 61;
                } else {
                    $file->filestatusid = 62;
                }


                $file->save();
            }

            session()->forget('responseArray');
        }





        return redirect()
            ->route('files.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseResponse  $caseresponses
     * @return \Illuminate\Http\Response
     */
    public function show(CaseResponse $caseresponses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaseResponse  $caseresponses
     * @return \Illuminate\Http\Response
     */
    public function edit(CaseResponse $caseresponses, File $file)
    {
    }

    public function editcaseresponses(CaseResponse $caseresponses, File $file, Request $request)
    {
        $file->id = $request->id;

        $caseresponses = CaseResponse::where('caseid', $file->id)->get();

        return view('caseresponses.edit', [
            'caseresponses' => $caseresponses,

            'file' => $file,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseResponse  $caseresponses
     * @return \Illuminate\Http\Response
     */
    public function updatecaseresponses(Request $request, CaseResponse $caseresponses, File $file)
    {

        $caseresponses = $request->input('caseresponses');


        // dd($caseresponses);
        // die;

        // if ($request->file()) {
        //     // date("Y-m-d H:i:s");
        //     $fileName = date('d-m-yy_H-i-s') . '_' . $request->file->getClientOriginalName();
        //     $filePath = $request->file('file')->storeAs('uploads/docs/policy/' . $fileName, 'public');
        //     return response()->json([$filePath]);
        // }

        foreach ($caseresponses as $row) {
            $caseresponses = CaseResponse::find($row['id']);
            if (isset($row['response'])) {
                $caseresponses->response = $row['response'];
                // dd( $caseresponses->response);
                $caseresponses->save();
            }
        }



        // die;
        return redirect()
            ->route('files.index');
    }


    public function update(Request $request, CaseResponse $caseresponses)
    {
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaseResponse  $caseresponses
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseResponse $caseresponses)
    {
        //
    }

    public function caseresponse(Request $request)
    {
        $responseArray = json_decode($request->input("getResponse"), true);

        $FileId = $request->input("getFileId");

        session(['responseArray' => $responseArray]);

        return view('caseresponses.verify')->with([
            'fileid' => $FileId,
            'responsearray' => $responseArray,
        ]);
    }


    public function fileupload($id, Request $request)
    {
        if ($request->file()) {



            // date("Y-m-d H:i:s");
            // $filename = $request->filename . '.' . $request->file->getClientOriginalExtension();
            // $request->file->getClientOriginalName();

            if (empty($request->filename)) {
                $filename = $request->file->getClientOriginalName() . '.' . $request->file->getClientOriginalExtension();
            } else {
                $filename = $request->filename . '.' . $request->file->getClientOriginalExtension();
            }


            $filePath = $request->file('file')->storeAs('uploads/docs/policy/' . $id, $filename, 'public');

            return response()->json([$filePath]);
        }
    }


    public function responsegeneratorlgv($fileid)
    {
        $report = new Report();
        $caseresponses = CaseResponse::where('caseid', $fileid)->get();


        $report->ismeet = "";
        $report->whommeet = "";
        $report->wheremeet = "";
        $report->address = "";
        $report->relation = "";
        $report->idproof = "";
        $report->idproofno = "";
        $report->addressproof = "";
        $report->addressproofno = "";
        $report->dob = "";
        $report->condition = "";
        $report->conditionreason = "";
        $report->anyillness = "";
        $report->detailsofillness = "";
        $report->hospitalisation = "";
        $report->documents = "";
        $report->otherpolicy = "";
        $report->policyno = "";
        $report->policycompany = "";
        $report->policycompanydetails = "";
        $report->locality = "";
        $report->localitytype = "";
        $report->ownership = "";
        $report->residencetype = "";
        $report->yearscurrentresidence = "";
        $report->modernappliaces = "";
        $report->noofmembers = "";
        $report->laeduqualification = "";
        $report->laeduproof = "";
        $report->empcategory = "";
        $report->employernameaddress = "";
        $report->laproofincome = "";
        $report->laselfemployednameaddress = "";
        $report->laselfemployedproof = "";
        $report->laannualincome = "";
        $report->islamarried = "";
        $report->nameofspouse = "";
        $report->spouserelation = "";
        $report->spouseemployment = "";
        $report->spouseincome = "";
        $report->ageofspouse = "";
        $report->standard = "";
        $report->ischeckneighbour = "";
        $report->neighbourname = "";
        $report->neighbourmobile = "";
        $report->neighbourconfirm = "";
        $report->lauploadphoto = "";
        $report->lauploadhouse = "";
        $report->lauploadidcardfront = "";
        $report->lauploadidcardback = "";
        $report->lauploadaddressprooffront = "";
        $report->lauploadaddressproofback = "";
        $report->remarkstvo = "";
        $report->possitiveassessment = "";
        $report->ifnegativedetails = "";

        foreach ($caseresponses as $caseresponse) {

            switch (trim($caseresponse->questionid)) {
                case (1):
                    $report->ismeet = $caseresponse->response ?? '';
                    break;
                case (2):
                    $report->whommeet = $caseresponse->response ?? '';
                    break;
                case (3):
                    $report->wheremeet = $caseresponse->response ?? '';
                    break;
                case (4):
                    $report->address = $caseresponse->response ?? '';
                    break;
                case (5):
                    $report->relation = $caseresponse->lookups->tag ?? '';
                    break;
                case (6):
                    $report->idproof = $caseresponse->lookups->tag ?? '';
                    break;
                case (7):
                    $report->idproofno = $caseresponse->response ?? '';
                    break;
                case (8):
                    $report->addressproof = $caseresponse->lookups->tag ?? '';
                    break;
                case (9):
                    $report->addressproofno = $caseresponse->response ?? '';
                    break;
                case (10):
                    $report->dob = $caseresponse->response ?? '';
                    break;
                case (11):
                    $report->condition = $caseresponse->lookups->tag ?? '';
                    break;
                case (12):
                    $report->conditionreason = $caseresponse->response ?? '';
                    break;
                case (13):
                    $report->anyillness = $caseresponse->response ?? '';
                    break;
                case (14):
                    $report->detailsofillness = $caseresponse->response ?? '';
                    break;
                case (15):
                    $report->hospitalisation = $caseresponse->response ?? '';
                    break;
                case (16):
                    $report->documents = $caseresponse->response ?? '';
                    break;
                case (17):
                    $report->otherpolicy = $caseresponse->response ?? '';
                    break;
                case (18):
                    $report->policyno = $caseresponse->response ?? '';
                    break;
                case (19):
                    $report->policycompany = $caseresponse->response ?? '';
                    break;
                case (20):
                    $report->policycompanydetails = $caseresponse->response ?? '';
                    break;
                case (21):
                    $report->locality = $caseresponse->lookups->tag ?? '';
                    break;
                case (22):
                    $report->localitytype = $caseresponse->lookups->tag ?? '';
                    break;
                case (23):
                    $report->ownership = $caseresponse->response ?? '';
                    break;
                case (24):
                    $report->residencetype = $caseresponse->lookups->tag ?? '';
                    break;
                case (25):
                    $report->yearscurrentresidence = $caseresponse->response ?? '';
                    break;
                case (26):
                    $report->modernappliaces = $caseresponse->response ?? '';
                    break;
                case (27):
                    $report->noofmembers = $caseresponse->response ?? '';
                    break;
                case (28):
                    $report->laeduqualification = $caseresponse->response ?? '';
                    break;
                case (29):
                    $report->laeduproof = $caseresponse->response ?? '';
                    break;
                case (30):
                    $report->empcategory = $caseresponse->lookups->tag ?? '';
                    break;
                case (31):
                    $report->employernameaddress = $caseresponse->response ?? '';
                    break;
                case (32):
                    $report->laproofincome = $caseresponse->response ?? '';
                    break;
                case (33):
                    $report->laselfemployednameaddress = $caseresponse->response ?? '';
                    break;
                case (34):
                    $report->laselfemployedproof = $caseresponse->response ?? '';
                    break;
                case (35):
                    $report->laannualincome = $caseresponse->response ?? '';
                    break;
                case (36):
                    $report->islamarried = $caseresponse->response ?? '';
                    break;
                case (37):
                    $report->nameofspouse = $caseresponse->response ?? '';
                    break;
                case (38):
                    $report->spouserelation = $caseresponse->response ?? '';
                    break;
                case (39):
                    $report->spouseemployment = $caseresponse->response ?? '';
                    break;
                case (40):
                    $report->spouseincome = $caseresponse->response ?? '';
                    break;
                case (41):
                    $report->ageofspouse = $caseresponse->response ?? '';
                    break;
                case (43):
                    $report->standard = $caseresponse->lookups->tag ?? '';
                    break;
                case (44):
                    $report->ischeckneighbour = $caseresponse->response ?? '';
                    break;
                case (45):
                    $report->neighbourname = $caseresponse->response ?? '';
                    break;
                case (46):
                    $report->neighbourmobile = $caseresponse->response ?? '';
                    break;
                case (47):
                    $report->neighbourconfirm = $caseresponse->response ?? '';
                    break;
                case (48):
                    $report->lauploadphoto = $caseresponse->response ?? '';
                    break;
                case (49):
                    $report->lauploadhouse = $caseresponse->response ?? '';
                    break;
                case (50):
                    $report->lauploadidcardfront = $caseresponse->response ?? '';
                    break;
                case (51):
                    $report->lauploadidcardback = $caseresponse->response ?? '';
                    break;
                case (52):
                    $report->lauploadaddressprooffront = $caseresponse->response ?? '';
                    break;
                case (53):
                    $report->lauploadaddressproofback = $caseresponse->response ?? '';
                    break;
                case (54):
                    $report->remarkstvo = $caseresponse->response ?? '';
                    break;
                case (55):
                    $report->possitiveassessment = $caseresponse->response ?? '';
                    break;
                case (56):
                    $report->ifnegativedetails = $caseresponse->response ?? '';
                    break;
                default:
            }
        }

        return $report;
    }
}
