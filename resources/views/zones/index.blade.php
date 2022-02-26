@extends('layouts.app')

@section('title')
List of Zones
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Zones</h4>
    </div>
</div>

<form action="{{route('zones.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('zones.create') }}">Create</a>

    @if($zones->isEmpty())
    <div class="alert alert-warning">
        The list of zones is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Zone</th> 
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($zones as $zone)
                <tr>
                    <th scope="row">{{$zone->id}}</th>
                    <td>{{$zone->name}}</td> 

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('zones.edit', $zone->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('zones.destroy',$zone->id)  }}" data-id="{{$zone->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $zones->links() }}


    </div>


    @endif
    @endsection