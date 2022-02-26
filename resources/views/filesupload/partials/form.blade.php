@csrf
<div class="row">
<div class="col-md-12 col-sm-12 ">
<div class="x_panel">
	<div class="x_title">
		<h2>Files <small>Create File</small></h2>
		
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Client</label>
<div class="col-md-6 col-sm-6 ">
    <select name="clientid" class="form-control">
        <option value=""> -- Select One --</option>

        @foreach($clients as $client)
        <div class="mb-3">
            <option value="{{ $client->id }}" @isset($file) {{  $client->id  == $file->clientid ? 'selected' : '' }} @endisset>{{ $client->name }}</option>
        </div>
        @endforeach

    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Hub</label>
<div class="col-md-6 col-sm-6 ">
    <select name="hubid" class="form-control">
        <option value=""> -- Select One --</option>

        @foreach($hubs as $hub)
        <div class="mb-3">
            <option value="{{ $hub->id }}" @isset($file) {{  $hub->id  == $file->hubid ? 'selected' : '' }} @endisset>{{ $hub->name }}</option>
        </div>
        @endforeach

    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">LOB</label>
<div class="col-md-6 col-sm-6 ">
    <select name="lobid" id="lobid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @foreach($lobs as $lob)
        <div class="col-12">
            <option value="{{ $lob->id }}" @isset($file) {{  $lob->id ==  $file->lobid ? 'selected' : '' }} @endisset> {{ $lob->name }}</option>
        </div>
        @endforeach
    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Sub LOB</label>
<div class="col-md-6 col-sm-6 ">
    <select name="typeid" id="typeid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @if($newcase == 1)
        @foreach($sublobs as $sublob)
        <option value="{{ $sublob->id }}" @isset($file) {{  $sublob->id == $file->typeid ? 'selected' : '' }} @endisset> {{ $sublob->name }}</option>
        @endforeach
        @endif
    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">State</label>
<div class="col-md-6 col-sm-6 ">
    <select name="stateid" id="stateid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @foreach($states as $state)
        <div class="mb-3">
            <option value="{{ $state->states->id }}" @isset($file) {{  $state->states->id == $file->stateid ? 'selected' : '' }} @endisset> {{ $state->states->name }}</option>
        </div>
        @endforeach

    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">City</label>
<div class="col-md-6 col-sm-6 ">

    <select name="cityid" id="cityid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @if($newcase == 1)
        @foreach($cities as $city)
        <option value="{{ $city->id }}" @isset($file) {{  $city->id == $file->cityid ? 'selected' : '' }} @endisset> {{ $city->name }}</option>
        @endforeach
        @endif
    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Location</label>
<div class="col-md-6 col-sm-6 ">
    <select name="locationid" id="locationid" class="form-control" required>
        @if($newcase == 1)
        @foreach($locations as $location)
        <option value="{{ $location->id }}" @isset($file) {{  $location->id == $file->locationid ? 'selected' : '' }} @endisset> {{ $location->name }}</option>
        @endforeach
        @endif
    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Multiple Location</label>
<div class="col-md-6 col-sm-6 ">
    <p>
        True:
        <input type="radio" class="flat" name="multipleloc" id="multiplelocT" value="1" /> False:
        <input type="radio" class="flat" name="multipleloc" id="multiplelocF" value="0" checked="" />
    </p>
    @error('multipleloc')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Agent Name</label>
<div class="col-md-6 col-sm-6 ">
    <input name="agent" type="text" class="form-control @error('agent') is-invalid @enderror" id="agent" aria-describedby="agent" value="{{isset($file->agent) ? $file->agent : old('agent')}}">
    @error('agent')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Customer Reference Label</label>
<div class="col-md-6 col-sm-6 ">
    <select name="reflabel" id="reflabel" class="form-control">
        <option value=""> -- Select One --</option>

        @foreach($reflabels as $reflabel)
        <option value="{{ $reflabel->id }}" @isset($file) {{  $reflabel->id == $file->reflabel ? 'selected' : '' }} @endisset> {{ $reflabel->tag }}</option>
        @endforeach

    </select>
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Customer Reference Number</label>
<div class="col-md-6 col-sm-6 ">
    <input name="policyno" type="text" class="form-control @error('policyno') is-invalid @enderror" id="policyno" aria-describedby="policyno" required value="{{isset($file->policyno) ? $file->policyno : old('policyno')}}">
    @error('policyno')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Other Reference Label</label>
<div class="col-md-6 col-sm-6 ">
    <select name="otherreflabel" id="otherreflabel" class="form-control">
        <option value=""> -- Select One --</option>

        @foreach($otherreflabels as $otherreflabel)
        <option value="{{ $otherreflabel->id }}" @isset($file) {{  $otherreflabel->id == $file->otherreflabel ? 'selected' : '' }} @endisset> {{ $otherreflabel->tag }}</option>
        @endforeach

    </select>
</div>
</div>


<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Other Reference Number</label>
<div class="col-md-6 col-sm-6 ">
    <input name="otherref" type="text" class="form-control @error('otherref') is-invalid @enderror" id="otherref" aria-describedby="otherref" value="{{isset($file->otherref) ? $file->otherref : old('otherref')}}">
    @error('otherref')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>


<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Received On</label>
<div class="col-md-6 col-sm-6 ">
    <input name="receivedon" type="date" class="form-control @error('receivedon') is-invalid @enderror date" id="receivedon" aria-describedby="receivedon" value="{{isset($file->receivedon) ? $file->receivedon : old('receivedon')}}">
    @error('receivedon')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name</label>
<div class="col-md-6 col-sm-6 ">
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value="{{isset($file->name) ? $file->name : old('name')}}">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Father's Name</label>
<div class="col-md-6 col-sm-6 ">
    <input name="fathername" type="text" class="form-control @error('fathername') is-invalid @enderror" id="fathername" aria-describedby="fathername" value="{{isset($file->fathername) ? $file->fathername : old('fathername')}}">
    @error('fathername')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">DOB</label>
<div class="col-md-6 col-sm-6 ">
    <input name="dob" type="date" class="form-control @error('dob') is-invalid @enderror date" id="dob" aria-describedby="dob" value="{{isset($file->dob) ? $file->dob : old('dob')}}">
    @error('dob')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nominee Name</label>
<div class="col-md-6 col-sm-6 ">
    <input name="nominee" type="text" class="form-control @error('nominee') is-invalid @enderror" id="nominee" aria-describedby="nominee" value="{{isset($file->nominee) ? $file->nominee : old('nominee')}}">
    @error('nominee')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>


<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Relationship</label>
<div class="col-md-6 col-sm-6 ">
    <select name="relationid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($relations as $relation)
        <div class="mb-3">
            <option value="{{ $relation->id }}" @isset($file) {{  $relation->id == $file->relationid ? 'selected' : '' }} @endisset> {{ $relation->tag }}</option>
        </div>
        @endforeach

    </select>
</div>
</div>


<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Address</label>
<div class="col-md-6 col-sm-6 ">
    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" value="{{isset($file->address) ? $file->address : old('address')}}">
    @error('address')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>

<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pincode</label>
<div class="col-md-6 col-sm-6 ">
    <input name="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" aria-describedby="pincode" value="{{isset($file->pincode) ? $file->pincode : old('pincode')}}">
    @error('pincode')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>
<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Mobile 1</label>
<div class="col-md-6 col-sm-6 ">
    <input name="mobile1" type="text" class="form-control @error('mobile1') is-invalid @enderror" id="mobile1" aria-describedby="mobile1" value="{{isset($file->mobile1) ? $file->mobile1 : old('mobile1')}}">
    @error('mobile1')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>
<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Mobile 2</label>
<div class="col-md-6 col-sm-6 ">
    <input name="mobile2" type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile2" aria-describedby="mobile2" value="{{isset($file->mobile2) ? $file->mobile2 : old('mobile2')}}">
    @error('mobile2')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>
<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email ID</label>
<div class="col-md-6 col-sm-6 ">
    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{isset($file->email) ? $file->email : old('email')}}">
    @error('email')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
</div>





<div class="ln_solid"></div>
<div class="item form-group">
	<div class="col-md-6 col-sm-6 offset-md-3">
		<a href="{{ url('files') }}" ><button class="btn btn-primary" type="button">Cancel</button></a>
		<button type="submit" class="btn btn-success">Submit</button>
	</div>
</div>



</div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $(document).ready(function() {

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
        });

        $('#dob').datepicker({
            maxDate: 0,
        });

        $('#incidentreported').datepicker({
            maxDate: 0,
        });

    });




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




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> -->



<!-- <script src="{{ asset(config('app.publicurl')) }}/js/jquery.min.js" defer></script> -->
<!-- <script src="{{ asset(config('app.publicurl')) }}/jquery-3.5.0.js" defer></script> -->
</link>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img_tag1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $('input[type=file]').change(function() {
        readURL(this);
    });
</script>