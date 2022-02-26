@extends('layouts.app')

@section('title')
    List of Users
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Users</h4>
    </div>
</div>

<form action="{{route('users.index')}}">
    @include('includes.common.search')
</form>
 

<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('users.create') }}">Create</a>

    @if($users->isEmpty())
    <div class="alert alert-warning">
        The list of Users is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th> 
                    <th scope="col">Login</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Vendor</th> 
                    <th scope="col">Actions</th> 

                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->code}}</td>
                    <td>{{$user->name}}</td>                    
                    <td>{{$user->login ?? ''}}</td> 
                    <td>{{$user->email ?? ''}}</td> 
                    <td>{{$user->mobile ?? ''}}</td> 
                    <td>{{$user->vendors->name ?? ''}}</td> 
                    <td>{{$user->status ?? ''}}</td> 

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('users.destroy',$user->id)  }}" data-id="{{$user->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}


    </div>

   
    @endif
    @endsection

 