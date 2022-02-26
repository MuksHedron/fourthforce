@extends('layouts.app')

@section('title')
List Of Cases
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Cases</h4>
    </div>
</div>

@if($role=="Administrator" || $role=="CRM")
<a class="btn btn-success mb-3" href="{{ route('files.create') }}" style="width: 100px;">Create</a>
@endif

<form action="{{route('files.index')}}">
    @include('includes.common.search')
</form>
<div style="margin-top:5px"></div>
<div style="margin-top:5px"></div>
@if($role=="Administrator" || $role=="Assignor")
<form class="form-inline" method="GET" action="{{route('files.index')}}">
    <div class="form-group mb-2">
        <select id='filter' name="filter" class="form-control" style="width: 200px">
            @isset($filestatuses)
            @if($filestatuses != null)
            <option value="">Select Case Status</option>
            @foreach ($filestatuses as $filestatus)
            <option value="{{ $filestatus->id }}" @isset($filestatuses) @endisset>{{ $filestatus->tag  }}</option>
            @endforeach
            @endif
            @endisset
        </select>
    </div>
    <button type="submit" class="btn btn-sm btn-primary" style="width: 60px;">Filter</button>
</form>
@endif

<div style="margin-top:5px"></div>

@if($files->isEmpty())
<div class="alert alert-warning">
    The list of Cases is empty
</div>
@else
<div class="table-responsive iq-card-body">
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>

                <th scope="col">#Id</th>
                <th scope="col">Type</th>
                <th scope="col">Customer Reference No</th>
                <th scope="col">User Name</th>
                <th scope="col">Address</th>
                <th scope="col">Location</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">Pincode</th>
                <th scope="col">Mobile</th>
                <th scope="col">Case Status</th>
                @if($role!="CRM")
                <th scope="col">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>

                <td scope="row">{{$file->id}}</td>
                <td>{{$file->sublobs->name ?? ''}}</td>
                <td>{{$file->policyno ?? ''}}</td>
                <td>{{$file->name ?? ''}}</td>
                <td>{{$file->address ?? ''}}</td>
                <td>{{$file->locations->name ?? ''}}</td>
                <td>{{$file->cities->name ?? ''}}</td>
                <td>{{$file->states->name ?? ''}}</td>
                <td>{{$file->pincode ?? ''}}</td>
                <td>{{$file->mobile1 ?? ''}}</td>
                <td>{{$file->lookups->tag ?? ''}}</td>
                @if($role!="CRM")
                <td>
                    <!-- <a class="btn btn-sm btn-primary" href="{{ route('files.edit', $file->id) }}" role="button">Edit File</a> -->

                    @if(($role=="CVO" || $role=="TVO" || $role=="Vendor"))
                    <a class="btn btn-sm btn-primary" href="{{ route('questionslob',['id' => $file->id] ) }}" role="button">Go To</a>
                    @endif


                    @if($role=="Processor" || $role=="QC")
                    <a class="btn btn-sm btn-success" href="{{ route('casetrackers.editcasetrackers',['id' => $file->id]) }}" role="button">{{$file->lookups->tag ?? ''}}</a>
                    <a class="btn btn-sm btn-secondary" href="{{ route('casetrackers.updatecasetrackersreturn',['id' => $file->id]) }}" role="button">Return</a>
                    @endif

                    @if(($role=="Assignor" || $role=="Administrator") && ($file->filestatusid==47 || $file->filestatusid==62 || $file->filestatusid==65 ))
                    <a class="btn btn-sm btn-primary" href="{{ route('files.assignfile',['id' => $file->id]) }}" role="button">Assign</a>
                    @endif


                    <!-- @if($file->filestatus!=47 )
                    <a class="btn btn-sm btn-primary" href="{{ route('caseresponses.editcaseresponses',['id' => $file->id]) }}" role="button">Edit Response</a>
                    @endif -->

                    <!-- <a class="btn btn-sm btn-primary" href="{{ route('casetrackers.editcasetrackers',['id' => $file->id]) }}" role="button" >{{$file->lookups->tag ?? ''}}</a> -->


                </td>
                @endif
            </tr>
            @endforeach


        </tbody>
    </table>

    {{ $files->links() }}

    <p>
        Displaying {{$files->count()}} of {{ $files->total() }} File(s).
    </p>
</div>




@endif









@endsection