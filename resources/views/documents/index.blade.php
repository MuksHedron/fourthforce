@extends('layouts.app')

@section('title')
List of Documents
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Documents</h4>
    </div>
</div>

<form action="{{route('documents.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('documents.create') }}">Create</a>

    @if($documents->isEmpty())
    <div class="alert alert-warning">
        The list of documents is empty
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
                @foreach($documents as $document)
                <tr>
                    <th scope="row">{{$document->id}}</th>
                    <td>{{$document->name}}</td>
                    <td>{{$document->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('documents.edit', $document->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('documents.destroy',$document->id)  }}" data-id="{{$document->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $documents->links() }}


    </div>


    @endif
    @endsection