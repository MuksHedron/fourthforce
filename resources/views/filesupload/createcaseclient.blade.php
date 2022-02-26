@extends('layouts.app')

@section('title')
Create Case
@endsection



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">{{ __('Create Case Client') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{route('files.createcase')}}" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="col-12">
                            <label for="clientid" class="required">Client</label>

                            <select name="clientid" class="form-control">
                                <option value=""> -- Select One --</option>

                                @foreach($clients as $client)
                                <div class="mb-3">
                                    <option value="{{ $client->id }}" @isset($file) {{  $client->id  == $file->clientid ? 'selected' : '' }} @endisset>{{ $client->name }}</option>
                                </div>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="hubid" class="required">Hub</label>

                            <select name="hubid" class="form-control">
                                <option value=""> -- Select One --</option>

                                @foreach($hubs as $hub)
                                <div class="mb-3">
                                    <option value="{{ $hub->id }}" @isset($file) {{  $hub->id  == $file->hubid ? 'selected' : '' }} @endisset>{{ $hub->name }}</option>
                                </div>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="lobid" class="required">LOB</label>
                            <select name="lobid" id="lobid" class="form-control" required>
                                <option value=""> -- Select One --</option>
                                @foreach($lobs as $lob)
                                <div class="col-12">
                                    <option value="{{ $lob->id }}" @isset($file) {{  $lob->id ==  $file->lobid ? 'selected' : '' }} @endisset> {{ $lob->name }}</option>
                                </div>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="typeid" class="required">Sub LOB</label>
                            <select name="typeid" id="typeid" class="form-control" required>
                                <option value=""> -- Select One --</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="stateid" class="required">State</label>

                            <select name="stateid" id="stateid" class="form-control" required>
                                <option value=""> -- Select One --</option>
                                @foreach($states as $state)
                                <div class="mb-3">
                                    <option value="{{ $state->id }}" @isset($file) {{  $state->id == $file->stateid ? 'selected' : '' }} @endisset> {{ $state->name }}</option>
                                </div>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="cityid" class="required">City</label>

                            <select name="cityid" id="cityid" class="form-control" required>

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="locationid" class="required">Location</label>
                            <select name="locationid" id="locationid" class="form-control" required>
                            </select>
                        </div>



                        <div class="form-group row mb-0" style="margin-top: 30px;">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>


    

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#lobid').change(function() {

        var lobID = $(this).val();

        if (lobID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getsublobs') }}?lob_id=" + lobID,
                success: function(res) {

                    if (res) {

                        $("#typeid").empty();
                        $("#typeid").append('<option>Select Sub Lob</option>');
                        $.each(res, function(key, value) {
                            $("#typeid").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#typeid").empty();
                    }
                }
            });
        } else {

            $("#typeid").empty();
        }
    });



    $('#stateid').change(function() {

        var stateID = $(this).val();

        if (stateID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getcities') }}?state_id=" + stateID,
                success: function(res) {

                    if (res) {

                        $("#cityid").empty();
                        $("#cityid").append('<option>Select City</option>');
                        $.each(res, function(key, value) {
                            $("#cityid").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#cityid").empty();
                    }
                }
            });
        } else {

            $("#cityid").empty();
            $("#locationid").empty();
        }
    });


    $('#cityid').on('change', function() {

        var cityID = $(this).val();

        if (cityID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getlocations') }}?city_id=" + cityID,
                success: function(res) {
                    if (res) {

                        $("#locationid").empty();
                        $("#locationid").append('<option>Select Location</option>');
                        $.each(res, function(key, value) {

                            $("#locationid").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#locationid").empty();
                    }
                }
            });
        } else {

            $("#locationid").empty();
        }
    });
</script>

@endsection