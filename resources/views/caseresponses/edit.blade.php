@extends('layouts.app')

@section('title')
Edit Case Responses
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Case Responses</h4>
    </div>
</div>


<div class="iq-card-body">
    <form method="POST" action="{{ route('updatecaseresponses',$file->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="col-sm-12" style="width:100%;margin: 20px;" id="form">
            @foreach($caseresponses as $caseresponse)

            <input type="hidden" name="caseresponses[{{$loop->index}}][id]" value="{{$caseresponse->id}}">

            @switch(trim($caseresponse->questions->type))
            @case('Text')
            <div class="form-group">
                <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                <input type="text" aria-describedby="response" name="caseresponses[{{$loop->index}}][response]" value="{{$caseresponse->response}}">
            </div>
            @break

            @case('Date')
            <div class="form-group">
                <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                <input type="date" aria-describedby="response" name="caseresponses[{{$loop->index}}][response]" value="{{$caseresponse->response}}">
            </div>
            @break

            @case('List')
            <div class="form-group">
                <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                <input type="text" aria-describedby="response" name="caseresponses[{{$loop->index}}][response]" disabled="true" value="{{$caseresponse->lookups->tag}}">
            </div>
            @break

            @case('File')
            <div class="form-group">
                <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                <input type="file" aria-describedby="response" name="caseresponses[{{$loop->index}}][response]" value="{{$caseresponse->response}}">
                <iframe src="{{asset('storage/'.$caseresponse->response) }}" name="caseresponses[{{$loop->index}}][response]" height="200px" width="100%" class="img_tag"></iframe>
            </div>
            @break

            @default
            <div class="form-group">
                <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                <input name="response" type="text" class="form-control @error('response') is-invalid @enderror" disabled="true" aria-describedby="response" value="{{isset($caseresponse->response) ? $caseresponse->response : old('response')}}">
            </div>
            @endswitch

            @endforeach

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>
    </form>
</div>







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> -->



<!-- <script src="{{ asset(config('app.publicurl')) }}/js/jquery.min.js" defer></script> -->
<!-- <script src="{{ asset(config('app.publicurl')) }}/jquery-3.5.0.js" defer></script> -->
<link rel="stylesheet" type="text/css" href="{{ asset(config('app.publicurl')) }}css/bootstrap.min.css">
</link>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img_tag').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $('input[type=file]').change(function() {
        readURL(this);
    });
</script>


@endsection