@extends('layouts.app')

@section('title')
List of Clients
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Clients</h4>
    </div>
</div>

<form action="{{route('clients.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('clients.create') }}">Create</a>

    @if($clients->isEmpty())
    <div class="alert alert-warning">
        The list of clients is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Short Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <th scope="row">{{$client->id}}</th>
                    <td>{{$client->name}}</td>
                    <td>{{$client->shortname ?? ''}}</td>
                    <td>{{$client->categories->name ?? ''}}</td>
                    <td>{{$client->cities->name ?? ''}}</td>
                    <td>{{$client->cities->states->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('clients.edit', $client->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('clients.destroy',$client->id)  }}" data-id="{{$client->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $clients->links() }}


    </div>


    @endif
    @endsection