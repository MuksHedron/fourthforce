@extends('layouts.app')

@section('title')
Create Case
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
    </div>
</div>
<div class="iq-card-body">
                    <form method="POST" action="{{route('fileupload.uploadfile')}}" enctype="multipart/form-data" class="row">
                        @include('filesupload.partials.upload_form',['create' => true ])
                    </form>
                
</div>

@endsection
