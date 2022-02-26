@extends('layouts.app')

@section('title')
Edit Role Work Flow
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Role Work Flow</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('roleworkflows.update', $roleworkflow->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('roleworkflows.partials.form')
    </form>
</div>

@endsection