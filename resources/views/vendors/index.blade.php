@extends('layouts.app')

@section('title')
List of Vendors
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Vendors</h4>
    </div>
</div>

<form action="{{route('vendors.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('vendors.create') }}">Create</a>

    @if($vendors->isEmpty())
    <div class="alert alert-warning">
        The list of Vendors is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Short Name</th>
                    <th scope="col">Email ID</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">City</th> 
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                <tr>
                    <th scope="row">{{$vendor->id}}</th>
                    <td>{{$vendor->name}}</td>
                    <td>{{$vendor->shortname}}</td>
                    <td>{{$vendor->email}}</td>
                    <td>{{$vendor->mobile}}</td>
                    <td>{{$vendor->cities->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('vendors.edit', $vendor->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('vendors.destroy',$vendor->id)  }}" data-id="{{$vendor->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $vendors->links() }}


    </div>


    @endif
    @endsection