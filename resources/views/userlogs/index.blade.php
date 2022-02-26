@extends('layouts.app')

@section('title')
List of User Logs
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of User Logs</h4>
    </div>
</div>

<form action="{{route('userlogs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <!-- <a class="btn btn-success mb-3" href="{{ route('userlogs.create') }}">Create</a> -->

    @if($userlogs->isEmpty())
    <div class="alert alert-warning">
        The list of userlogs is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Token</th>
                    <th scope="col">Login</th>
                    <th scope="col">Logout</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($userlogs as $userlog)
                <tr>
                    <th scope="row">{{$userlog->id}}</th>
                    <td>{{$userlog->users->name}}</td>
                    <td>{{$userlog->token ?? ''}}</td>
                    <td>{{$userlog->login ?? ''}}</td>
                    <td>{{$userlog->logout ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('userlogs.edit', $userlog->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('userlogs.destroy',$userlog->id)  }}" data-id="{{$userlog->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $userlogs->links() }}


    </div>


    @endif
    @endsection