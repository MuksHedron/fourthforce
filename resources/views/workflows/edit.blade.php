@extends('layouts.app')

@section('title')
Edit  Work Flow
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Work Flow</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('workflows.update', $workflow->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('workflows.partials.form')
    </form>
</div>

@endsection