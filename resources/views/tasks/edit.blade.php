@extends('layouts.app')

@section('title')
Edit Task
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Task</h4>
    </div>
</div>
<div class="iq-card-body">

    <form method="POST" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('tasks.partials.form')
    </form>
</div>

@endsection