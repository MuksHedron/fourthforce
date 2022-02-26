<?php

namespace App\Http\Controllers;

use App\Models\CaseResponse;
use App\Models\File;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class ReportController extends Controller
{
    public function reportpolicyno(Request $request)
    {
        $file = new File();

        return view('reports.reportpolicyno')->with([
            'file' => $file,
        ]);
    }


    public function generatePDF(Request $request, File $file, CaseResponse $caseresponses)
    {
        $policyno = $request->policyno;
        $file = File::where('policyno', $policyno)->first();

        $report = (new CaseResponseController)->responsegeneratorlgv($file->id);

        $caseresponses = CaseResponse::where('caseid', $file->id)->get();


        switch (trim($file->clientid)) {
            case (1):
                $dompdf =  new Dompdf();


                $context = stream_context_create(array(
                    'ssl' => array(
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                        'allow_self_signed' => TRUE
                    ),

                ));

                $dompdf->setHttpContext($context);
                $dompdf->set_option('isHtml5ParserEnabled', true);
                $dompdf->set_option('isRemoteEnabled', true);




                $dompdf->loadHTML(view('reports.policyno.clients.icici')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                ]));


                $dompdf->render();

                $dompdf->stream($policyno . '.pdf', ['Attachment' => false]);
                break;
            case (2):
                $dompdf =  new Dompdf();
                $dompdf->loadHTML(view('reports.policyno.clients.maxlife')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                ]));
                $dompdf->render();

                $dompdf->stream($policyno . '.pdf', ['Attachment' => false]);
                break;
            case (3):
                $dompdf =  new Dompdf();





                $dompdf->loadHTML(view('reports.policyno.clients.sbi')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                ]));
                $dompdf->render();

                $dompdf->stream($policyno . '.pdf', ['Attachment' => false]);
                break;
            case (4):
                $dompdf =  new Dompdf();
                $dompdf->loadHTML(view('reports.policyno.clients.pnb')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                ]));
                $dompdf->render();

                $dompdf->stream($policyno . '.pdf', ['Attachment' => false]);
                break;
            default:
                $dompdf =  new Dompdf();
                $dompdf->loadHTML(view('reports.policyno.clients.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                ]));
                $dompdf->render();

                $dompdf->stream($policyno . '.pdf', ['Attachment' => false]);
        }
    }


    public function reportpolicy(Request $request, File $file, CaseResponse $caseresponses)
    {
        $file = File::where('policyno', $request->policyno)->first();

        $report = (new CaseResponseController)->responsegeneratorlgv($file->id);

        $caseresponses = CaseResponse::where('caseid', $file->id)->get();

        switch (trim($file->clientid)) {
            case (1):
                return view('reports.policyno.reports')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                    'client' => 'icici',
                ]);
                break;
            case (2):
                return view('reports.policyno.reports')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                    'client' => 'maxlife',
                ]);
                break;
            case (3):
                return view('reports.policyno.reports')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                    'client' => 'sbi',
                ]);
                break;
            case (4):
                return view('reports.policyno.reports')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                    'client' => 'pnb',
                ]);
                break;
            default:
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                    'caseresponses' => $caseresponses,
                    'client' => 'reportpolicy',
                ]);
        }





        return view('reports.reportpolicyno')->with([
            'file' => $file,
            'report' => $report,
        ]);
    }
}
