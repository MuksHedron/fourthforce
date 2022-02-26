@extends('layouts.app')

@section('title')
List of Lookups
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Lookups</h4>
    </div>
</div>

<form action="{{route('lookups.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('lookups.create') }}">Create</a>

    @if($lookups->isEmpty())
    <div class="alert alert-warning">
        The list of lookups is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Type</th>
                    <th scope="col">Tag</th>
                    <th scope="col">Value</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($lookups as $lookup)
                <tr>
                    <th scope="row">{{$lookup->id}}</th>
                    <td>{{$lookup->type}}</td>
                    <td>{{$lookup->tag}}</td>
                    <td>{{$lookup->value ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('lookups.edit', $lookup->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('lookups.destroy',$lookup->id)  }}" data-id="{{$lookup->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $lookups->links() }}


    </div>


    @endif
    @endsection