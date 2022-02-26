@extends('layouts.app')

@section('title')
List of Locations
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Lobs</h4>
    </div>  
</div>

<form action="{{route('lobs.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('lobs.create') }}">Create</a>

    @if($lobs->isEmpty())
    <div class="alert alert-warning">
        The list of Lob is empty
    </div>
    @else

<div class="table-responsive iq-card-body">
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">LOB</th>
                <th scope="col">LOB Short Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lobs as $lob)
            <tr>
                <th scope="row">{{$lob->id}}</th>
                <td>{{$lob->name}}</td>
                <td>{{$lob->shortname}}</td> 
                <td>

                    <a class="btn btn-sm btn-primary" href="{{ route('lobs.edit', $lob->id) }}" role="button">Edit</a>

                    <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('lobs.destroy',$lob->id)  }}" data-id="{{$lob->id}}" data-target="#custom-width-modal">Delete</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $lobs->links() }}


</div>




@endif

@endsection