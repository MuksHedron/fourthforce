@extends('layouts.app')

@section('title')
Create Vendor
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Vendor</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('vendors.store')}}" enctype="multipart/form-data">
        @include('vendors.partials.form',['create' => true ])
    </form>
</div>

@endsection