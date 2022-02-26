<?php

namespace App\Http\Controllers;

use App\Models\CaseResponse;
use App\Models\CaseSummary;
use App\Models\File;
use Illuminate\Http\Request;

class CaseSummaryController extends Controller
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

        $casesummaries = CaseSummary::SearchCaseSummaries($q)
            ->paginate(10);

        return view('casesummaries.index')->with([
            'casesummaries' => $casesummaries
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $files =  File::all()->sortBy("name");

        return view('casesummaries.create')->with([
            'files' => $files,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseSummary  $casesummary
     * @return \Illuminate\Http\Response
     */
    public function show(CaseSummary $casesummary)
    {
        $files =  File::all()->sortBy("name");

        return view('casesummaries.create')->with([
            'files' => $files,
            'casesummary' => $casesummary,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaseSummary  $casesummary
     * @return \Illuminate\Http\Response
     */
    public function edit(CaseSummary $casesummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseSummary  $casesummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseSummary $casesummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaseSummary  $casesummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseSummary $casesummary)
    {
        //
    }


    public function casesummarylgv($fileid)
    {
        $report = (new CaseResponseController)->responsegeneratorlgv($fileid);

        $summary = "";

        if ($report->ismeet == "Yes") {
            $summary = 'Our Executive met the LA at the address Provided and verified his ID via ' . $report->idproof . ' bearing the number ' . $report->idproofno . '. ';
        } else {
            $summary = 'Our Executive did not meet the LA at the address provided and instead met ' . $report->whommeet . ' at ' . $report->wheremeet . ' who is ' . $report->relation . ' to the LA. ';
            $summary . 'The LA\'s address was verified via ' . $report->idproof . ' bearing the ID  ' . $report->idproofno . '. The LA was born on  ' . $report->dob . '. ';
        }
        $report->condition == "Good";
        if ($report->condition != "Not Good" || $report->condition != "Others") {
            $summary = $summary . 'The health condition of LA is found to be ' . $report->condition . ' and no hospitalisation was required during the past 10 years. ';
        } else {
            $summary = $summary . 'The LA\'s health condition was Not Good and has a disclosed illness history of ' . $report->anyillness . ' for which hospitalisation ';

            if ($report->hospitalisation) {
                $summary = $summary . 'was required at ' . $report->hospitalisation . ' was not required ';
            }
        }

        if ($report->otherpolicy == "Yes") {
            $summary = $summary . 'The LA has atleast one other health policy bearing the details with ' . $report->policyno . '. ';
        } else {
            $summary = $summary . 'The LA does not hold any other health policy.';
        }

        $summary = $summary . 'The LA is residing in a  ' . $report->locality . ' locality, with ' . $report->noofmembers . ' family members, in a ' . $report->ownership . ' ' . $report->residencetype . ', during the past ' . $report->yearscurrentresidence . ' years and ' . $report->modernappliaces . ' modern alliances are to be seen. The LA\'s standard of living is ' . $report->yearscurrentresidence . '. ';

        $summary = $summary . 'The LA possess ' . $report->laeduqualification . ' educational qualitification ';

        if ($report->laeduproof) {
            $summary = $summary . 'which was verified. ';
        } else {
            $summary = $summary . 'which was not verified. ';
        }


        if ($report->empcategory == "self-employed") {
            $summary = $summary . ' The LA is self-employed at ' . $report->laselfemployednameaddress;
            if ($report->laselfemployedproof) {
                $summary = $summary . ' which was verified ';
            } else {
                $summary = $summary . ' which was not verified ';
            }
            $summary = $summary . ' with a disclosed annual income of ' . $report->laannualincome . ' ';
            if ($report->laselfemployedproof) {
                $summary = $summary . ' which was verified ';
            } else {
                $summary = $summary . ' which was not verified ';
            }
        } else {
            $summary = $summary . ' The LA is employed at ' . $report->employernameaddress . '';
            if ($report->laproofincome) {
                $summary = $summary . ' which was verified ';
            } else {
                $summary = $summary . ' which was not verified ';
            }
            $summary = $summary . ' with a disclosed annual income of ' . $report->laannualincome . ' ';
            if ($report->laproofincome) {
                $summary = $summary . ' which was verified ';
            } else {
                $summary = $summary . ' which was not verified ';
            }
        }


        if ($report->islamarried == "Yes") {
            $summary = $summary . ' The LA is Married to ' . $report->nameofspouse . ' aged ' . $report->ageofspouse . ' with an ' . $report->spouseincome . '  annual income. ';
        } else {
            $summary = $summary . ' The LA is Unmarried. ';
        }



        if ($report->ischeckneighbour == "Yes") {
            $summary = $summary . 'The LA information was verified through his neighbour ' . $report->neighbourname . ' with a mobile number ' . $report->neighbourmobile . ', ';

            if ($report->neighbourconfirm == "Yes") {
                $summary = $summary . 'who confirmed the LA\'s stay.';
            } else {
                $summary = $summary . 'who not confirmed the LA\'s stay.';
            }
        } else {
            $summary = $summary . 'The LA information was not verified through his neighbour';
        }

        return $summary;
    }
}
