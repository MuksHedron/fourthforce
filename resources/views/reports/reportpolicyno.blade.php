@extends('layouts.app')

@section('title')
Policy Reports
@endsection

@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Policy Reports</h4>
    </div>
</div>


<div class="iq-card-body">
    <form method="POST" action="{{route('reports.policy')}}">
        @csrf


        <div class="col-12">
            <label for="policyno" class="required">Customer Reference No</label>
            <input name="policyno" type="text" class="form-control @error('policyno') is-invalid @enderror" id="policyno" aria-describedby="policyno" required value="{{isset($file->policyno) ? $file->policyno : old('policyno')}}">
            @error('policyno')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
            @enderror
        </div>



        <div class="form-group row mb-0" style="margin-top: 30px;">
            <div class="col-md-12 offset-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>

@endsection