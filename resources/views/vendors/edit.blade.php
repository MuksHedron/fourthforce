@extends('layouts.app')

@section('title')
Edit Vendor
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Vendor</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('vendors.update', $vendor->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('vendors.partials.form')
    </form>
</div>

@endsection