@extends('layouts.app')

@section('title')
List of Tasks
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Tasks</h4>
    </div>
</div>

<form action="{{route('tasks.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('tasks.create') }}">Create</a>

    @if($tasks->isEmpty())
    <div class="alert alert-warning">
        The list of tasks is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Short Name</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{$task->id}}</th>
                    <td>{{$task->name}}</td>
                    <td>{{$task->shortname ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('tasks.edit', $task->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('tasks.destroy',$task->id)  }}" data-id="{{$task->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tasks->links() }}


    </div>


    @endif
    @endsection