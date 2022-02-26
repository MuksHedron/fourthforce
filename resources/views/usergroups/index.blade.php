@extends('layouts.app')

@section('title')
List of User Groups
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of User Groups</h4>
    </div>
</div>

<form action="{{route('usergroups.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('usergroups.create') }}">Create</a>

    @if($usergroups->isEmpty())
    <div class="alert alert-warning">
        The list of User Groups is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th> 
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($usergroups as $usergroup)
                <tr>
                    <th scope="row">{{$usergroup->id}}</th>
                    <td>{{$usergroup->name}}</td> 

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('usergroups.edit', $usergroup->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('usergroups.destroy',$usergroup->id)  }}" data-id="{{$usergroup->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $usergroups->links() }}


    </div>


    @endif
    @endsection