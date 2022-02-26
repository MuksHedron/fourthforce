@extends('layouts.app')

@section('title')
List of Hubs
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Hubs</h4>
    </div>
</div>

<form action="{{route('hubs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('hubs.create') }}">Create</a>

    @if($hubs->isEmpty())
    <div class="alert alert-warning">
        The list of hubs is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Hub</th>
                    <th scope="col">Category</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($hubs as $hub)
                <tr>
                    <th scope="row">{{$hub->id}}</th>
                    <td>{{$hub->name}}</td>
                    <td>{{$hub->categories->name ?? ''}}</td>
                    <td>{{$hub->cities->name ?? ''}}</td>
                    <td>{{$hub->cities->states->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('hubs.edit', $hub->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('hubs.destroy',$hub->id)  }}" data-id="{{$hub->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $hubs->links() }}


    </div>


    @endif
    @endsection