@extends('layouts.app')

@section('title')
List Of User Roles
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">User Roles</h4>
    </div>
</div>

<form action="{{route('userroles.index')}}">
    @include('includes.common.search')
</form>

<a class="btn btn-success mb-3" href="{{ route('userroles.create') }}">Create</a>

@if($userroles->isEmpty())
<div class="alert alert-warning">
    The list of User Roles is empty
</div>
@else
<div class="table-responsive iq-card-body">
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">User</th>
                <th scope="col">Mail ID</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userroles as $userrole)
            <tr>
                <th scope="row">{{$userrole->id}}</th>
                <td>{{$userrole->users->name ?? ''}}</td>
                <td>{{$userrole->users->email ?? ''}}</td>
                <td>{{$userrole->roles->name ?? ''}}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('userroles.edit', $userrole->id) }}" role="button">Edit</a>

                    <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('userroles.destroy',$userrole->id)  }}" data-id="{{$userrole->id}}" data-target="#custom-width-modal">Delete</a>

                </td>
            </tr>
            @endforeach


        </tbody>
    </table>

    {{ $userroles->links() }}

    <p>
        Displaying {{$userroles->count()}} of {{ $userroles->total() }} userrole(s).
    </p>
</div>




@endif

@endsection