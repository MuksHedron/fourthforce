@extends('layouts.app')

@section('title')
List of Hub Locations
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Hub Locations</h4>
    </div>
</div>

<form action="{{route('hublocs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('hublocs.create') }}">Create</a>

    @if($hublocs->isEmpty())
    <div class="alert alert-warning">
        The list of Hub Locations is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Hub</th>
                    <th scope="col">Location</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($hublocs as $hubloc)
                <tr>
                    <th scope="row">{{$hubloc->id}}</th>
                    <td>{{$hubloc->hubs->name}}</td>
                    <td>{{$hubloc->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('hublocs.edit', $hubloc->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('hublocs.destroy',$hubloc->id)  }}" data-id="{{$hubloc->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $hublocs->links() }}


    </div>


    @endif
    @endsection