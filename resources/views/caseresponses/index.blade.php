@extends('layouts.app')

@section('title')
List Of Case Responses
@endsection



@section('content')



@if($caseresponses->isEmpty())
<div class="alert alert-warning">
    The list of Case Responses is empty
</div>
@else

<form action="{{route('caseresponses.index')}}">
    @include('includes.common.search')
</form>

<div class="table-responsive iq-card-body">
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">File Name</th> 
                <th scope="col">Question No</th> 
                <th scope="col">Question</th> 
                <th scope="col">Case Response</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($caseresponses as $caseresponse)
            <tr>
                <th scope="row">{{$caseresponse->id}}</th>
                <td>{{$caseresponse->files->policyno}}</td>
                <td>{{$caseresponse->questionid}}</td>
                <td>{{$caseresponse->questions->question}}</td>
                <td>{{$caseresponse->response}}</td>
               
            </tr>
            @endforeach

 
        </tbody>
    </table>

    <!-- {{ $caseresponses->links() }} -->


</div>




@endif

@endsection