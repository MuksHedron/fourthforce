@extends('layouts.app')

@section('title')
Create Document
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Document</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('documents.store')}}" enctype="multipart/form-data">
        @include('documents.partials.form',['create' => true ])
    </form>
</div>

@endsection