@extends('layouts.app')

@section('title')
Edit Category
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Category</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('categories.partials.form')
    </form>
</div>

@endsection