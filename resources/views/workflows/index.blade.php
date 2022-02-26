@extends('layouts.app')

@section('title')
List of Work Flows
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of  Work Flows</h4>
    </div>
</div>

<form action="{{route('workflows.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('workflows.create') }}">Create</a>

    @if($workflows->isEmpty())
    <div class="alert alert-warning">
        The list of workflows is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Work Flow State</th>
                    <th scope="col">Work Flow Order</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($workflows as $workflow)
                <tr>
                    <th scope="row">{{$workflow->id}}</th>
                    <td>{{$workflow->wfstate}}</td>
                    <td>{{$workflow->wforder ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('workflows.edit', $workflow->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('workflows.destroy',$workflow->id)  }}" data-id="{{$workflow->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $workflows->links() }}


    </div>


    @endif
    @endsection