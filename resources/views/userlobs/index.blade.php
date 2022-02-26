@extends('layouts.app')

@section('title')
List of User Lobs
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of User Lobs</h4>
    </div>
</div>

<form action="{{route('userlobs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('userlobs.create') }}">Create</a>

    @if($userlobs->isEmpty())
    <div class="alert alert-warning">
        The list of userlobs is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Sub Lob</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($userlobs as $userlob)
                <tr>
                    <th scope="row">{{$userlob->id}}</th>
                    <td>{{$userlob->users->name}}</td>
                    <td>{{$userlob->sublobs->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('userlobs.edit', $userlob->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('userlobs.destroy',$userlob->id)  }}" data-id="{{$userlob->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $userlobs->links() }}


    </div>


    @endif
    @endsection