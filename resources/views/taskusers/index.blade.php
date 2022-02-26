@extends('layouts.app')

@section('title')
List of Task Users
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Task Users</h4>
    </div>
</div>

<form action="{{route('taskusers.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('taskusers.create') }}">Create</a>

    @if($taskusers->isEmpty())
    <div class="alert alert-warning">
        The list of taskusers is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($taskusers as $taskuser)
                <tr>
                    <th scope="row">{{$taskuser->id}}</th>
                    <td>{{$taskuser->taskroles->tasks->name}}</td>
                    <td>{{$taskuser->users->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('taskusers.edit', $taskuser->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('taskusers.destroy',$taskuser->id)  }}" data-id="{{$taskuser->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $taskusers->links() }}


    </div>


    @endif
    @endsection