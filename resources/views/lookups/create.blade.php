@extends('layouts.app')

@section('title')
Create Lookup
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Lookup</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('lookups.store')}}" enctype="multipart/form-data">
        @include('lookups.partials.form',['create' => true ])
    </form>
</div>

@endsection