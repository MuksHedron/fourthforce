@extends('layouts.app')

@section('title')
Create Task
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Create Task</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{route('tasks.store')}}" enctype="multipart/form-data">
        @include('tasks.partials.form',['create' => true ])
    </form>
</div>

@endsection