@extends('layouts.app')

@section('title')
List of Questions
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Questions</h4>
    </div>
</div>

<form action="{{route('questions.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('questions.create') }}">Create</a>

    @if($questions->isEmpty())
    <div class="alert alert-warning">
        The list of Questions is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Sub Lob</th>
                    <th scope="col">Question Group</th>
                    <th scope="col">Question Id</th>
                    <th scope="col">Question </th>
                    <th scope="col">Type </th>
                    <th scope="col">Mandatory </th>
                    <th scope="col">Jumpto </th>

                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr>
                    <th scope="row">{{$question->id}}</th>
                    <td>{{$question->sublobs->name ?? ''}}</td>
                    <td>{{$question->questiongroup}}</td>
                    <td>{{$question->questionid ?? ''}}</td>
                    <td>{{$question->question ?? ''}}</td>
                    <td>{{$question->type ?? ''}}</td>
                    <td>{{$question->mandatory ?? ''}}</td>
                    <td>{{$question->jumpto ?? ''}}</td>

                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('questions.edit', $question->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('questions.destroy',$question->id)  }}" data-id="{{$question->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $questions->links() }}


    </div>


    @endif
    @endsection