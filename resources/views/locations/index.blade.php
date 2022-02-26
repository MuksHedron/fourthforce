@extends('layouts.app')

@section('title')
List of Locations
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Locations</h4>
    </div>  
</div>

<form action="{{route('locations.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('locations.create') }}">Create</a>

    @if($locations->isEmpty())
    <div class="alert alert-warning">
        The list of locations is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Location</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr>
                    <th scope="row">{{$location->id}}</th>
                    <td>{{$location->name}}</td>
                    <td>{{$location->cities->name ?? ''}}</td>
                    <td>{{$location->cities->states->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('locations.edit', $location->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('locations.destroy',$location->id)  }}" data-id="{{$location->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $locations->links() }}


    </div>


    @endif
    @endsection