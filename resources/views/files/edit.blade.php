@extends('layouts.app')

@section('title')
Edit Case
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit File</h4>
    </div>
</div>
<div class="iq-card-body">
                    <form method="POST" action="{{ route('files.update', $file->id) }}" enctype="multipart/form-data" class="row">
                        @method('PATCH')
                        @include('files.partials.edit_form')
                    </form>
                
</div>


@endsection
