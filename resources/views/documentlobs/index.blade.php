@extends('layouts.app')

@section('title')
List of Document Lobs
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Document Lobs</h4>
    </div>

</div>

<form action="{{route('documentlobs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('documentlobs.create') }}">Create</a>

    @if($documentlobs->isEmpty())
    <div class="alert alert-warning">
        The list of documentlobs is empty
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
                @foreach($documentlobs as $documentlob)
                <tr>
                    <th scope="row">{{$documentlob->id}}</th>
                    <td>{{$documentlob->name}}</td>
                    <td>{{$documentlob->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('documentlobs.edit', $documentlob->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('documentlobs.destroy',$documentlob->id)  }}" data-id="{{$documentlob->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $documentlobs->links() }}


    </div>


    @endif
    @endsection