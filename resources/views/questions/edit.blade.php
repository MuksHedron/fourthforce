@extends('layouts.app')

@section('title')
Edit Question
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Question</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('questions.update', $question->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('questions.partials.form')
    </form>
</div>

@endsection