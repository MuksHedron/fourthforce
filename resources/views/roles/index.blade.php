@extends('layouts.app')

@section('title')
List of Roles
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Roles</h4>
    </div>
</div>

<form action="{{route('roles.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('roles.create') }}">Create</a>

    @if($roles->isEmpty())
    <div class="alert alert-warning">
        The list of roles is empty
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
                @foreach($roles as $role)
                <tr>
                    <th scope="row">{{$role->id}}</th>
                    <td>{{$role->name}}</td> 
 
                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('roles.edit', $role->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('roles.destroy',$role->id)  }}" data-id="{{$role->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $roles->links() }}


    </div>


    @endif
    @endsection