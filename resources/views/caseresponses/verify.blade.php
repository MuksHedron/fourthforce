@extends('layouts.app')

@section('title')
List Of QAs
@endsection



@section('content')


<form name="frm_questions" id="frmQuestions" method="POST" action="{{route('caseresponses.store')}}">
    @csrf
 
    
    <input name="getFileId" type="hidden" class="form-control" id="fileid" value="{{$fileid}}"> 

    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <tbody>
                @foreach ($responsearray as $key)
                @foreach ($key as $value)
                @if (isset($value["response"]))
                <tr>
                    <td>{{$value["questionid"]}} : {{$value["question"] }}</td>
                </tr>
                <tr>
                    <td>Ans: {{ $value["response"]}} </td>
                </tr>
                @endif
                @endforeach
                @endforeach

            </tbody>
        </table>

        <input type="submit" value="Submit" class="btn btn-success">
</form>

@endsection