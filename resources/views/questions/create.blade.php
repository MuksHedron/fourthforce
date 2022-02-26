@extends('layouts.app')

@section('title')
Create Question
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Question</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('questions.store')}}" enctype="multipart/form-data">
        @include('questions.partials.form',['create' => true ])
    </form>
</div>

@endsection