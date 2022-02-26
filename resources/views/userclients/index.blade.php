@extends('layouts.app')

@section('title')
List of User Clients
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of User Clients</h4>
    </div>
</div>

<form action="{{route('userclients.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('userclients.create') }}">Create</a>

    @if($userclients->isEmpty())
    <div class="alert alert-warning">
        The list of userclients is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Client</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($userclients as $userclient)
                <tr>
                    <th scope="row">{{$userclient->id}}</th>
                    <td>{{$userclient->users->name}}</td>
                    <td>{{$userclient->clients->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('userclients.edit', $userclient->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('userclients.destroy',$userclient->id)  }}" data-id="{{$userclient->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $userclients->links() }}


    </div>


    @endif
    @endsection