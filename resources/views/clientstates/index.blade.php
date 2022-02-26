@extends('layouts.app')

@section('title')
List of Client States
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Client States</h4>
    </div>
</div>

<form action="{{route('clientstates.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('clientstates.create') }}">Create</a>

    @if($clientstates->isEmpty())
    <div class="alert alert-warning">
        The list of Client States is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Client</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($clientstates as $clientstate)
                <tr>
                    <th scope="row">{{$clientstate->id}}</th>
                    <td>{{$clientstate->clients->name}}</td>
                    <td>{{$clientstate->states->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('clientstates.edit', $clientstate->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('clientstates.destroy',$clientstate->id)  }}" data-id="{{$clientstate->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $clientstates->links() }}


    </div>


    @endif
    @endsection