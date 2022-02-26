@extends('layouts.app')

@section('title')
List Of Files
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Files</h4>
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
            <option value="">Select File Status</option>
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
    The list of files is empty
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
                <th scope="col">File Status</th>
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
                <td>{{$file->mobile ?? ''}}</td>
                <td>{{$file->lookups->tag ?? ''}}</td>
                @if($role!="CRM")
                <td>

                    <a class="btn btn-sm btn-primary" href="{{ route('files.assignfile',['id' => $file->id]) }}" role="button">{{$file->lookups->tag ?? ''}}</a>

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