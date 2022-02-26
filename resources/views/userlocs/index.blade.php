@extends('layouts.app')

@section('title')
List of User Locations
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of User Locations</h4>
    </div>
</div>

<form action="{{route('userlocs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('userlocs.create') }}">Create</a>

    @if($userlocs->isEmpty())
    <div class="alert alert-warning">
        The list of userlocs is empty
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
                @foreach($userlocs as $userloc)
                <tr>
                    <th scope="row">{{$userloc->id}}</th>
                    <td>{{$userloc->users->name}}</td>
                    <td>{{$userloc->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('userlocs.edit', $userloc->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('userlocs.destroy',$userloc->id)  }}" data-id="{{$userloc->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $userlocs->links() }}


    </div>


    @endif
    @endsection