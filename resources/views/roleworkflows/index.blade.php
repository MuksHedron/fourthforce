@extends('layouts.app')

@section('title')
List of Role Work Flows
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Role Work Flows</h4>
    </div>
</div>

<form action="{{route('roleworkflows.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('roleworkflows.create') }}">Create</a>

    @if($roleworkflows->isEmpty())
    <div class="alert alert-warning">
        The list of roleworkflows is empty
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
                @foreach($roleworkflows as $roleworkflow)
                <tr>
                    <th scope="row">{{$roleworkflow->id}}</th>
                    <td>{{$roleworkflow->name}}</td>
                    <td>{{$roleworkflow->locations->name ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('roleworkflows.edit', $roleworkflow->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('roleworkflows.destroy',$roleworkflow->id)  }}" data-id="{{$roleworkflow->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $roleworkflows->links() }}


    </div>


    @endif
    @endsection