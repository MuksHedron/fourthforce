<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Carbon\Carbon;
use DB;
use Mail;
use App\Traits\EmailTrait;

class HomeController extends Controller
{
	use EmailTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		
	    $this->sendmail('fileSave');
        $q = null;

        if ($request->has('q')) $q = $request->query('q');

        $auth_user_id = Auth::user()->id;

        $role = (new FileController)->roles($auth_user_id);

        $status = (new FileController)->actionStatus($role);

        $today_cases = File::whereDate('dtcr', Carbon::today())->count();
        $week_data = File::whereBetween(
            'dtcr',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        )
            ->groupBy('dtcr')
            ->orderBy('dtcr', 'ASC')
            ->get(array(
                DB::raw('Date(dtcr) as date'),
                DB::raw('COUNT(*) as "count"')
            ));
        //print_r($week_data);exit;
        $week_cases = [];
        $week_dates = [];
        foreach ($week_data as $key => $res) {
            //array_push($week_cases,array(strtotime($res->date) * 1000,$res->count));
            array_push($week_cases, $res->count);
            $week_dates[$res->date] = $res->count;
        }
        //print_r($week_dates);exit;
        $week_days = array();
        $case_counts = [];
        $startDate = Carbon::now()->startOfWeek();
        for ($x = 0; $x < 7; $x++) {
            $casecount = 0;
            $date = date('Y-m-d', strtotime("+$x days", strtotime($startDate)));
            $week_days[] = $date;

            if (array_key_exists($date, $week_dates)) {
                $casecount = $week_dates[$date];
            }
            $case_counts[] = $casecount;
        }
        if (empty($status)) {
            $status = [0, 0];
        }

        if ($role == "Administrator" || $role == "CRM") {
            $files = (new FileController)->indexQueryFilter($q);
        } else if ($role == "Assignor") {
            $status = (new FileController)->actionStatus($role);
            $q = $status[0];
            $files = (new FileController)->indexFilter($q);

            $location = "";
            $users = (new FileController)->fieldusers($location);


            return view('home')->with([
                'files' => $files,
                'users' => $users,
                'role' => $role,
                'today_cases' => $today_cases,
                'week_cases' => $week_cases,
                'week_days' => $week_days,
                'case_counts' => $case_counts
            ]);
        } else if ($role == "CVO" || $role == "TVO" || $role == "Vendor") {
            $files = (new FileController)->indexUserFieldFilter($auth_user_id, $status, $q);
        } else {

            $files = (new FileController)->indexUserFilter($auth_user_id, $status, $q);
        }

        if (Auth::user()->vendorid == "0" || Auth::user()->vendorid == "") {
            return view('home')->with([
                'files' => $files,
                'role' => $role,
                'today_cases' => $today_cases,
                'week_cases' => $week_cases,
                'week_days' => $week_days,
                'case_counts' => $case_counts
            ]);
        } else {

            return view('vendor_home')->with([
                'files' => $files,
                'role' => $role,
                'today_cases' => $today_cases,
                'week_cases' => $week_cases,
                'week_days' => $week_days,
                'case_counts' => $case_counts
            ]);
        }
    }
	
}
