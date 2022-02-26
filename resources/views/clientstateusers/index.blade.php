@extends('layouts.app')

@section('title')
List of Client State Users
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Client State Users</h4>
    </div>
</div>

<form action="{{route('clientstateusers.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('clientstateusers.create') }}">Create</a>

    @if($clientstateusers->isEmpty())
    <div class="alert alert-warning">
        The list of clientstateusers is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($clientstateusers as $clientstateuser)
                <tr>
                    <th scope="row">{{$clientstateuser->id}}</th>
                    <td>{{$clientstateuser->users->name}}</td>
                    <td>{{$clientstateuser->clientstates->states->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('clientstateusers.edit', $clientstateuser->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('clientstateusers.destroy',$clientstateuser->id)  }}" data-id="{{$clientstateuser->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $clientstateusers->links() }}


    </div>


    @endif
    @endsection