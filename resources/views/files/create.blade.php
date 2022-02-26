@extends('layouts.app')

@section('title')
Create Case
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Files</h4>
    </div>
</div>
<div class="iq-card-body">
                    <form method="POST" action="{{route('files.store')}}" enctype="multipart/form-data" class="row">
                        @include('files.partials.form',['create' => true ])
                    </form>
                
</div>

@endsection
