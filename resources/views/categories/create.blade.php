@extends('layouts.app')

@section('title')
Create Category
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Category</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
        @include('categories.partials.form',['create' => true ])
    </form>
</div>

@endsection