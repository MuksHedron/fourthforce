@csrf
<div class="row">
<div class="col-md-12 col-sm-12 ">
<div class="x_panel">
	<div class="x_title">
		<h2>Files <small>Upload File</small></h2>
		
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">File</label>
<div class="col-md-6 col-sm-6 ">
    <input type="file" class="form-control" name="uploaded_file">
</div>
</div>	
	



<div class="ln_solid"></div>
<div class="item form-group">
	<div class="col-md-6 col-sm-6 offset-md-3">
		<a href="{{ url('fileupload') }}" ><button class="btn btn-primary" type="button">Cancel</button></a>
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