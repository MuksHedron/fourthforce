@extends('layouts.app')

@section('title')
List of Case Summary
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Case Summary</h4>
    </div>
</div>

<form action="{{route('casesummaries.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('casesummaries.create') }}">Create</a>

    @if($casesummaries->isEmpty())
    <div class="alert alert-warning">
        The list of casesummaries is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Case</th>
                    <th scope="col">Summary</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($casesummaries as $casesummary)
                <tr>
                    <th scope="row">{{$casesummary->id}}</th> 
                    <td>{{$casesummary->files->policyno ?? ''}}</td>
                    <td>{{$casesummary->summary ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('casesummaries.edit', $casesummary->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('casesummaries.destroy',$casesummary->id)  }}" data-id="{{$casesummary->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $casesummaries->links() }}


    </div>


    @endif
    @endsection