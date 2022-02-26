@extends('layouts.app')

@section('title')
List of Sub Lobs
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Sub Lobs</h4>
    </div>
</div>

<form action="{{route('sublobs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('sublobs.create') }}">Create</a>

    @if($sublobs->isEmpty())
    <div class="alert alert-warning">
        The list of sublobs is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Sub Lob</th>
                    <th scope="col">Short Name</th>
                    <th scope="col">Lob</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($sublobs as $sublob)
                <tr>
                    <th scope="row">{{$sublob->id}}</th>
                    <td>{{$sublob->name}}</td>
                    <td>{{$sublob->shortname}}</td>
                    <td>{{$sublob->lobs->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('sublobs.edit', $sublob->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('sublobs.destroy',$sublob->id)  }}" data-id="{{$sublob->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $sublobs->links() }}


    </div>


    @endif
    @endsection