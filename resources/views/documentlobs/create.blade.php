@extends('layouts.app')

@section('title')
Create Document Lob
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Document Lob</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('documentlobs.store')}}" enctype="multipart/form-data">
        @include('documentlobs.partials.form',['create' => true ])
    </form>
</div>

@endsection