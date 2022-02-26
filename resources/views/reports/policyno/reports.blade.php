@extends('layouts.app')

@section('title')
Reports
@endsection

@section('content')
<div class="d-flex justify-content-end mb-4">
    <!-- <a class="btn btn-primary" href="{{ route('generate-pdf') }}">Export to PDF</a> -->


    <form name="frm_questions" id="frmQuestions" method="get" action="{{route('generate-pdf')}}" enctype="multipart/form-data">
        @csrf

        <input name="policyno" type="hidden" class="form-control" id="policyno" value="{{$file->policyno ?? ''}}">

        <button type="submit" class="btn btn-sm btn-primary" style="width: 160px;">Export to PDF</button>

    </form>
</div>


@switch(trim($client))

@case('icici')
@include('reports.policyno.clients.icici')
@break

@case('maxlife')
@include('reports.policyno.clients.maxlife')
@break

@case('sbi')
@include('reports.policyno.clients.sbi')
@break

@case('pnb')
@include('reports.policyno.clients.pnb')
@break

@default
@include('reports.policyno.clients.reportpolicy')
@endswitch





@endsection