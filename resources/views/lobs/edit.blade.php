@extends('layouts.app')

@section('title')
Edit Lob
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Lob</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('lobs.update', $lob->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('lobs.partials.form')
    </form>
</div>

@endsection