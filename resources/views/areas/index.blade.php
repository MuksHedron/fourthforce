@extends('layouts.app')

@section('title')
List of Areas
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Areas</h4>
    </div>
</div>

<form action="{{route('areas.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('areas.create') }}">Create</a>

    @if($areas->isEmpty())
    <div class="alert alert-warning">
        The list of areas is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($areas as $area)
                <tr>
                    <th scope="row">{{$area->id}}</th>
                    <td>{{$area->name}}</td>
                    <td>{{$area->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('areas.edit', $area->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('areas.destroy',$area->id)  }}" data-id="{{$area->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $areas->links() }}


    </div>


    @endif
    @endsection