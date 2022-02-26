@extends('layouts.app')

@section('title')
Create Work Flow
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Work Flow</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('workflows.store')}}" enctype="multipart/form-data">
        @include('workflows.partials.form',['create' => true ])
    </form>
</div>

@endsection