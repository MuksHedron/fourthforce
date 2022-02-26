@extends('layouts.app')

@section('title')
List of States
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of States</h4>
    </div>
</div>

<form action="{{route('states.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('states.create') }}">Create</a>

    @if($states->isEmpty())
    <div class="alert alert-warning">
        The list of states is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">State</th>
                    <th scope="col">Zone</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($states as $state)
                <tr>
                    <th scope="row">{{$state->id}}</th>
                    <td>{{$state->name}}</td>
                    <td>{{$state->zones->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('states.edit', $state->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('states.destroy',$state->id)  }}" data-id="{{$state->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $states->links() }}


    </div>


    @endif
    @endsection