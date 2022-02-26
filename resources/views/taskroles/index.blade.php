@extends('layouts.app')

@section('title')
List of Task Roles
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Task Roles</h4>
    </div>
</div>

<form action="{{route('taskroles.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('taskroles.create') }}">Create</a>

    @if($taskroles->isEmpty())
    <div class="alert alert-warning">
        The list of Task Role is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Role Name</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($taskroles as $taskrole)
                <tr>
                    <th scope="row">{{$taskrole->id}}</th>
                    <td>{{$taskrole->tasks->name}}</td>
                    <td>{{$taskrole->roles->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('taskroles.edit', $taskrole->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('taskroles.destroy',$taskrole->id)  }}" data-id="{{$taskrole->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $taskroles->links() }}


    </div>


    @endif
    @endsection