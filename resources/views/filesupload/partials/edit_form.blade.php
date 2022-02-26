@csrf
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Upload Files <small>Update File</small></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Client</label>
                    <div class="col-md-6 col-sm-6 ">
					<input type="hidden" name="batch_id" value="{{ $file->batch_id}}">
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
					<span class="font-red">{{ $file->lobname }}</span>
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
<span class="font-red">{{ $file->typename }}</span>
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
<span class="font-red">{{ $file->statename }}</span>
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
					<span class="font-red">{{ $file->cityname }}</span>
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
						<span class="font-red">{{ $file->hubname }}</span>
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
						<span class="font-red">{{ $file->locationname }}</span>
                    </div>
                </div>



                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Multiple Location</label>
                    <div class="col-md-6 col-sm-6 ">
                        <p>
                            True:
                            <input type="radio" class="flat" name="multipleloc" id="multiplelocT" value="1" {{  $file->multipleloc == "1" ? 'checked' : '' }} /> False:
                            <input type="radio" class="flat" name="multipleloc" id="multiplelocF" value="0" {{  $file->multipleloc == "0" ? 'checked' : '' }} />
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
						<span class="font-red">{{ $file->reflabelname }}</span>
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
						<span class="font-red">{{ $file->otherreflabelname }}</span>
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
						<span class="font-red">{{ $file->relationname }}</span>
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
                        <a href="{{ url('fileupload') }}"><button class="btn btn-primary" type="button">Cancel</button></a>
                        <button type="submit" class="btn btn-success" onclick=checkSubmit();>Submit</button>
                    </div>
                </div>




                <!--div class="form-group row mb-0" style="margin-top: 30px;">
    <div class="col-md-12 offset-md-12">
        <a href="{{ url('/files') }}"></a><button type="button" class="btn btn-secondary">cancel</button></a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div-->





            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

</link>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {

        fileid = $('#fileid').val();
        auth_id = $('#authid').val();
        // var urlGetQuestionGroups = "{{ url('/questionsgroups') }}/" + fileid;
        var urlGetQuestionGroups = "{{ url('/questionsgroups') }}";



        urlGetLookUps = "{{ url('/lookupslob') }}/" + fileid;


        let questionGroupId = 0;
        if (fileid) {
            $.ajax({
                url: urlGetQuestionGroups,
                data: {
                    id: fileid,
                    auth_id: auth_id
                },
                type: "GET",
                dataType: "json",
                success: function(data) {
                    lobQAGroups = data;
                },
                complete: function() {
                    getLookups();
                    getQuestions();
                }
            });
        }


        $('.img_tag').hide();

        getZones();

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
                            states = res;
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




    let lobQAGroups = [];
    let lobQA = [];
    let lobResponseQA = [];
    let lookups = [];
    let zones = [];
    let states = [];
    let cities = [];
    let locations = [];
    var fileid;

    // select all elements 
    const form = document.getElementById("form");
    const question = document.getElementById("question");

    let lastQuestion = lobQA.length - 1;
    var currentQuestions = 0;
    var currentGroupId = 0;
    var content = "";
    var urlGetLookUps = "";

    var mselectedValue;
    var clickUpload = 0;
    var lastElement;
    var zoneID = 0;
    var stateID = 0;
    var cityID = 0;

    function getQuestions() {
        questionGroupId = lobQAGroups[0][currentGroupId].id;
        urlGetQuestions = "{{ url('/questionslob') }}/" + questionGroupId;
        $.ajax({
            url: urlGetQuestions,
            data: {
                id: questionGroupId,
                fileid: fileid
            },
            type: "GET",
            dataType: "json",
            success: function(data) {
                lobQA = data;
                renderQuestion();
                form.style.display = "block";
            },
        });



        lastgroup = lobQAGroups[0].length - 1;
        for (i = 0; i <= lastgroup; i++) {
            if (i === questionGroupId) {
                $('*[class*=div_' + questionGroupId + ']').css("display", "block");
            } else {
                $('*[class*=div_' + i + ']').css("display", "none");
                $('*[class*=btnContinue]').css("display", "none");
            }
        }

    }

    function getLookups() {
        $.ajax({
            url: urlGetLookUps,
            type: "GET",
            dataType: "json",
            success: function(data) {
                lookups = data;
            }
        });
    }


    function saveFiles(elementId) {
        if (lastElement === undefined || lastElement === "") {
            lastElement = elementId;
        } else if (lastElement === elementId) {
            clickUpload++;
        } else {
            clickUpload = 1;
        }
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img_tag_' + elementId).attr('src', e.target.result);
        }

        reader.readAsDataURL($('input[id="response_' + elementId + '"]').get(0).files[0]);

        var file_data = $('input[id="response_' + elementId + '"]').get(0).files[0];
        urlGetUploadFiles = "{{ url('/fileupload') }}/" + fileid;
        var fileName = fileid + '_' + elementId.split("_")[0] + '_' + mselectedValue + '_' + clickUpload;
        var fd = new FormData();
        fd.append("file", file_data);
        fd.append("isFirst", true);
        fd.append("fileName", fileName);
        $.ajax({
            url: urlGetUploadFiles,
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            data: fd,
            success: function(data) {
                var qIndex = elementId.split("_")[1];
                lobQA[0][qIndex].response = data[0];
                $("#img_tag_" + elementId).show();
            },
            error: function(e) {
                console.log("ERROR : ", e);
                $("#img_tag_" + elementId).hide();
            }
        });

        mselectedValue = "";
    }



    function readURL(input, elementId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img_tag_' + elementId).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    function checkNextQuestionGroup() {

        isValidate = true;

        for (i = currentQuestions; i <= lastQuestion; i++) {

            let q = lobQA[0][i];

            if ($('.' + q.id).val() === "") {
                $('.' + q.id).css('border', '1px solid red')
                isValidate = false;
            } else {
                $('.' + q.id).css('border', '1px solid #ced4da');
                isValidate = true;
            }

        }
        if (isValidate) {
            lobResponseQA.push(...lobQA);
            currentGroupId++;
            getQuestions();
        }


    }




    function renderQuestion() {
        lastQuestion = lobQA[0].length - 1;

        for (i = currentQuestions; i <= lastQuestion; i++) {
            renderQuestionHtmlElement(i);
            renderResponse(i);
        }

        $('.img_tag').hide();
        let q = lobQA[0][lastQuestion];

        if (q.jumpto === 0) {
            //   renderSubmit();
        } else if (q.taskid === lobQAGroups[0][lastgroup].id) {
            //  renderSubmit();
        } else {
            //  renderContinue();
        }



        for (i = currentQuestions; i <= lastQuestion; i++) {
            let q = lobQA[0][i];
            if (q.jumpto > 0 && i !== lastQuestion) {
                disableMultiple(q.questionid + 1, q.jumpto);
            }
        }



    }

    function renderQuestionHtmlElement(qIndex) {

        content = "";

        let q = lobQA[0][qIndex];

        name = q.questionid;

        var id = q.id + '_' + qIndex;
        content += '<div class="div_' + currentGroupId + '"  class="form-group"  name="' + name + '" > ';
        content += '<div id="div_' + id + '"  class="form-group div_' + currentGroupId + '"  name="' + name + '" > ';
        content += '<label id="lbl_' + id + '"class="div_' + currentGroupId + '""  name="' + name + '">' + q.question + '</label>';
    }

    // render a answer

    function renderResponse(qIndex) {

        let q = lobQA[0][qIndex];
        var id = q.id + '_' + qIndex;
        name = q.questionid;
        switch (q.type.trim()) {
            case 'Boolean':
                renderResponseHtmlElement('Boolean', id, name);
                break;
            case 'Reverse Boolean':
                renderResponseHtmlElement('Reverse Boolean', id, name);
                break;
            case 'Text':
                renderResponseHtmlElement('Text', id, name);
                break;
            case 'Date':
                renderResponseHtmlElement('Date', id, name);
                break;
            case 'TextArea':
                renderResponseHtmlElement('TextArea', id, name);
                break;
            case 'Radio':
                renderResponseHtmlElement('Radio', id, name);
                break;
            case 'List':
                renderResponseHtmlElement('List', id, name);
                break;
            case 'List-Docs':
                renderResponseHtmlElement('List-Docs', id, name);
                break;
            case 'File':
                renderResponseHtmlElement('File', id, name);
                break;
            default:
                renderResponseHtmlElement('Text', id, name);
        }
    }



    function renderResponseHtmlElement(elementType, elementId, name) {
        switch (elementType) {
            case 'Boolean':
                content += '<select id= "response_' + elementId + '"  name="' + name + '" onchange=checkResponse(\'' + elementId + '\'); class= "form-control ' + name + '"><option value="">---- Select Option ----</option><option value="Yes">Yes</option><option value="No">No</option></select>';
                question.innerHTML += content;
                break;
            case 'Reverse Boolean':
                content += '<select id= "response_' + elementId + '" name="' + name + '" onchange=checkResponse(\'' + elementId + '\'); class= "form-control ' + name + '"><option value="">---- Select Option ----</option><option value="Yes">Yes</option><option value="No">No</option></select>';
                question.innerHTML += content;
                break;
            case 'Text':
                content += '<input id= "response_' + elementId + '" name="' + name + '" type="text" class="form-control ' + name + '" autocomplete="off" onchange=checkResponse(\'' + elementId + '\');>';
                question.innerHTML += content;
                break;
            case 'Date':
                content += '<input id= "response_' + elementId + '"  type="date" name="' + name + '" class="form-control ' + name + '"  autocomplete="off" onchange=checkResponse(\'' + elementId + '\');>';
                question.innerHTML += content;
                break;
            case 'TextArea':
                content += '<textarea id= "response_' + elementId + '" name="' + name + '" class="form-control ' + name + '"  rows="3" onchange=checkResponse(\'' + elementId + '\');></textarea>';
                question.innerHTML += content;
                break;
            case 'Radio':
                content += '<div id= "div_' + elementId + '" >';
                content += '<div class="input-group mb-3">';
                content += '<input id= "response_' + elementId + '" class="form-check-input ' + name + '" type="radio" nname="' + name + '" value="option1" checked>';
                content += '</div></div>';
                question.innerHTML += content;
                break;
            case 'List':
                content += '<select id= "response_' + elementId + '" name="' + name + '" onchange=checkResponse(\'' + elementId + '\'); class= "form-control ' + name + '" > ' + renderSelectOptions(elementId); + '</select>';
                question.innerHTML += content;
                break;
            case 'List-Docs':
                content += '<select id= "response_' + elementId + '" name="' + name + '" onchange=checkResponse(\'' + elementId + '\'); class= "form-control ' + name + '" > ' + renderSelectOptions(elementId); + '</select>';
                content += '<input id= "response_' + elementId + '" name="' + name + '" type="file"   class="form-control-file ' + name + '" onchange=checkResponse(\'' + elementId + '\'); >';
                content += '<iframe src="#" id="img_tag_' + elementId + '" height="200px" width="100%"   class="img_tag" />';
                question.innerHTML += content;
                break;
            case 'File':
                content += '<input id= "response_' + elementId + '" name="' + name + '" type="file"   class="form-control-file ' + name + '" onchange=checkResponse(\'' + elementId + '\'); >';
                content += '<iframe src="#" id="img_tag_' + elementId + '" height="200px" width="100%"   class="img_tag" />';
                question.innerHTML += content;
                break;
            default:
                content += '<input id= "response_' + elementId + '" name="' + name + '" type="text"   class="form-control ' + name + '"  autocomplete="off" onchange=checkResponse(\'' + elementId + '\');>';
                question.innerHTML += content;
        }
    }


    urlGetZones = "{{ url('getzones') }}";

    function getZones() {
        $.ajax({
            url: urlGetZones,
            type: "GET",
            dataType: "json",
            success: function(data) {
                zones = data;
            }
        });
    }

    function getStates() {
        urlGetStates = "{{ url('getstatesfromzones') }}?zone_id=" + zoneID;
        $.ajax({
            url: urlGetStates,
            type: "GET",
            dataType: "json",
            success: function(data) {
                states = data;
            }
        });
    }

    function getCities() {
        urlGetCities = "{{ url('getcities') }}?state_id=" + stateID;
        $.ajax({
            url: urlGetCities,
            type: "GET",
            dataType: "json",
            success: function(data) {
                cities = "";
                cities = data;
            }
        });
    }


    function getLocations() {
        urlGetLocations = "{{ url('getlocations') }}?city_id=" + cityID;
        $.ajax({
            url: urlGetLocations,
            type: "GET",
            dataType: "json",
            success: function(data) {
                locations = "";
                locations = data;
            }
        });
    }



    function renderSelectOptions(elementId) {

        var qIndex = elementId.split("_")[1];
        var currentQ = elementId.split("_")[0];

        var optionsHTML = "";
        let q = lobQA[0][qIndex];
        var lookupValue = q.lookuptype;
        optionsHTML += '<option value=""> ---- Select ' + lookupValue + ' ----</option>';
        if (lookupValue === "Zone") {
            $.each(zones, function(key, value) {
                optionsHTML += '<option value="' + value.id + '">' + value.name + '</option>';
            });
        } else {
            for (var val in lookups[0]) {
                if (lookupValue === lookups[0][val].type) {
                    optionsHTML += '<option value="' + lookups[0][val].id + '">' + lookups[0][val].tag + '</option>';
                }
            }
        }




        return optionsHTML;
    }

    // renderSubmit
    function renderSubmit() {
        content = "";
        content += '<input type="button" class="btn btn-success" value="Submit" style="margin-top: 20px" onclick=checkSubmit();>';
        question.innerHTML += content;
    }

    function checkSubmit() {
        lobResponseQA.push(...lobQA);
        $('#response').val(JSON.stringify(lobResponseQA));
        // document.getElementById("frmQuestions").submit();
    }

    // renderContinue
    function renderContinue() {
        content = "";
        content += '<input type="button" class="btn btn-primary btn-rounded btnContinue" value="Continue" style="margin-top: 20px" onclick=checkNextQuestionGroup();>';
        question.innerHTML += content;
    }

    // renderBack
    function renderBack() {
        content = "";
        content += '<input type="button" class="btn btn-primary btn-rounded" value="Back" style="margin-top: 20px" >';
        question.innerHTML += content;
    }

    function emptyListOptions(currentQ, qIndex, lookuptype) {

        let q1 = lobQA[0][tempqIndex];
        var tempcurrentQ = currentQ;
        var tempqIndex = qIndex;
        if (lookuptype === "Zone") {
            tempcurrentQ++;
            tempqIndex++;
            q1 = lobQA[0][tempqIndex];
            $('#response_' + tempcurrentQ + '_' + tempqIndex).empty().append('<option value=""> ---- Select ' + q1.lookuptype + ' ----</option>');
            tempcurrentQ++;
            tempqIndex++;
            q1 = lobQA[0][tempqIndex];
            $('#response_' + tempcurrentQ + '_' + tempqIndex).empty().append('<option value=""> ---- Select ' + q1.lookuptype + ' ----</option>');
            tempcurrentQ++;
            tempqIndex++;
            q1 = lobQA[0][tempqIndex];
            $('#response_' + tempcurrentQ + '_' + tempqIndex).empty().append('<option value=""> ---- Select ' + q1.lookuptype + ' ----</option>');
        }

        if (lookuptype === "State") {
            tempcurrentQ++;
            tempqIndex++;
            q1 = lobQA[0][tempqIndex];
            $('#response_' + tempcurrentQ + '_' + tempqIndex).empty().append('<option value=""> ---- Select ' + q1.lookuptype + ' ----</option>');
            tempcurrentQ++;
            tempqIndex++;
            q1 = lobQA[0][tempqIndex];
            $('#response_' + tempcurrentQ + '_' + tempqIndex).empty().append('<option value=""> ---- Select ' + q1.lookuptype + ' ----</option>');
        }

        if (lookuptype === "City") {
            tempcurrentQ++;
            tempqIndex++;
            q1 = lobQA[0][tempqIndex];
            $('#response_' + tempcurrentQ + '_' + tempqIndex).empty().append('<option value=""> ---- Select ' + q1.lookuptype + ' ----</option>');
        }

    }


    function renderListOptions(currentQ, qIndex, lookuptype) {

        var tempcurrentQ = currentQ;
        var tempqIndex = qIndex;

        tempcurrentQ++;
        tempqIndex++;

        if (lookuptype === "Zone") {
            setTimeout(
                function() {
                    var optionsHTML = "";
                    $.each(states, function(key, value) {
                        optionsHTML += '<option value="' + key + '">' + value + '</option>';
                    });

                    $('#response_' + tempcurrentQ + '_' + tempqIndex).append(optionsHTML);
                }, 1000);
        }

        if (lookuptype === "State") {
            setTimeout(
                function() {
                    var optionsHTML = "";
                    $.each(cities, function(key, value) {
                        optionsHTML += '<option value="' + key + '">' + value + '</option>';
                    });

                    $('#response_' + tempcurrentQ + '_' + tempqIndex).append(optionsHTML);
                }, 1000);
        }

        if (lookuptype === "City") {
            setTimeout(
                function() {
                    var optionsHTML = "";
                    $.each(locations, function(key, value) {
                        optionsHTML += '<option value="' + key + '">' + value + '</option>';
                    });

                    $('#response_' + tempcurrentQ + '_' + tempqIndex).append(optionsHTML);
                }, 1000);
        }
    }

    function checkResponse(elementId) {

        var response = $('#response_' + elementId).val();
        $('#response_' + elementId).attr("value", response);

        var qIndex = elementId.split("_")[1];
        var currentQ = elementId.split("_")[0];

        var nextQ = parseInt(currentQ) + 1;

        lobQA[0][qIndex].response = response;
        let q = lobQA[0][qIndex];

        if (q.lookuptype === "Zone") {
            zoneID = response;
            emptyListOptions(currentQ, qIndex, q.lookuptype);
            getStates();
            renderListOptions(currentQ, qIndex, q.lookuptype);
        }

        if (q.lookuptype === "State") {
            stateID = response;
            emptyListOptions(currentQ, qIndex, q.lookuptype)
            getCities();
            renderListOptions(currentQ, qIndex, q.lookuptype);

        }

        if (q.lookuptype === "City") {
            cityID = response;
            emptyListOptions(currentQ, qIndex, q.lookuptype)
            getLocations();
            renderListOptions(currentQ, qIndex, q.lookuptype);
        }

        jumpto = q.jumpto + '_' + currentQ;

        switch (q.type.trim()) {
            case 'Boolean':
                selectedElements(elementId);
                if (response === "Yes") {
                    disableMultiple(q.questionid + 1, q.jumpto);
                } else {
                    enableMultiple(q.questionid + 1, q.jumpto);
                }
                break;
            case 'Reverse Boolean':
                selectedElements(qIndex);
                if (response === "No") {
                    disableMultiple(q.questionid + 1, q.jumpto);
                } else {
                    enableMultiple(q.questionid + 1, q.jumpto);
                }
                break;
            case 'Text':
                // enableElements(jumpto);
                break;
            case 'Date':
                // enableElements(jumpto);
                break;
            case 'TextArea':
                // enableElements(jumpto);
                break;
            case 'Radio':
                // enableElements(jumpto);
                break;
            case 'List':
                selectedElements(currentQ);

                // enableElements(jumpto);
                break;
            case 'List-Docs':
                selectedElements(elementId);
                saveFiles(elementId);
                // enableElements(jumpto);
                break;
            case 'File':
                saveFiles(elementId);
                // enableElements(jumpto);
                break;
            default:
                // enableElements(jumpto);
        }

    }

    function selectedElements(elementId) {

        var selectedValue = $('#response_' + elementId).val();
        mselectedValue = $('#response_' + elementId).val();

        // $('#response_' + elementId + ' option').removeAttr('selected')
        // $('#response_' + elementId + ' option[value=' + selectedValue + ']').attr("selected", "selected");

    }

    function enableMultiple(fromName, toName) {
        for (k = fromName; k < toName; k++) {
            // $('*[name*=' + i + ']').removeAttr('disabled', 'disabled');

            $("*[name*=" + k + "]").css("display", "block");
        }
    }

    function disableMultiple(fromName, toName) {
        for (l = fromName; l < toName; l++) {
            // $('*[name*=' + i + ']').attr('disabled', 'disabled');

            $("*[name*=" + l + "]").css("display", "none");
        }
    }
</script>