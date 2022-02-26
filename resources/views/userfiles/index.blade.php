@extends('layouts.app')

@section('title')
List Of User Files
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">User Files</h4>
    </div>
</div>

<form action="{{route('userfiles.index')}}">
    @include('includes.common.search')
</form>

<a class="btn btn-success mb-3" href="{{ route('userfiles.create') }}">Create</a>


@if($userfiles->isEmpty())
<div class="alert alert-warning">
    The list of User Cases is empty
</div>
@else
<div class="table-responsive iq-card-body">
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Case Id</th>
                <th scope="col">Case Name</th>
                <th scope="col">File Client</th>
                <th scope="col">File Location</th>
                <th scope="col">Approver Mail ID</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userfiles as $userfile)
            <tr>
                <th scope="row">{{$userfile->id}}</th>
                <td>{{$userfile->files->id ?? ''}}</td>
                <td>{{$userfile->files->name ?? ''}}</td>
                <!-- <td>{{$userfile->files->policyno ?? ''}}</td> -->
                <td>{{$userfile->files->clients->name ?? ''}}</td>
                <td>{{$userfile->files->locations->name ?? ''}}</td>
                <td>{{$userfile->users->email ?? ''}}</td>
                <td>{{$userfile->users->userroles->roles->name ?? ''}}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('userfiles.edit', $userfile->id) }}" role="button">Edit</a>

                    <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('userfiles.destroy',$userfile->id)  }}" data-id="{{$userfile->id}}" data-target="#custom-width-modal">Delete</a>

                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
    {{ $userfiles->links() }}
</div>




@endif

@endsection