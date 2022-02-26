@extends('layouts.app')

@section('title')
Work Flow
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Work Flow</h4>
    </div>
</div>




<div class="iq-card-body">
    <form method="POST" action="{{ route('casetrackers.updatecasetrackers',$fileid) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="col-sm-12" style="width:100%;margin: 20px;" id="form">

            <table class="table table-bordered border-primary">
                <tbody>

                    @foreach($caseresponses as $caseresponse)

                    <input type="hidden" name="caseresponses[{{$caseresponse->questions->questionid}}][id]" value="{{$caseresponse->id}}">

                    @switch(trim($caseresponse->questions->type))

                    @case('Boolean')
                    <tr>
                        <td> <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                        </td>
                        <td> <input type="text" aria-describedby="response" name="caseresponses[{{$caseresponse->questions->questionid}}][response]" value="{{$caseresponse->response}}" disabled="true">
                        </td>
                    </tr>
                    @break

                    @case('Reverse Boolean')
                    <tr>
                        <td>
                            <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                        </td>
                        <td> <input type="text" aria-describedby="response" name="caseresponses[{{$caseresponse->questions->questionid}}][response]" value="{{$caseresponse->response}}" disabled="true">
                        </td>
                    </tr>
                    @break


                    @case('Text')
                    <tr>
                        <td>
                            <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                        </td>
                        <td> <input type="text" aria-describedby="response" name="caseresponses[{{$caseresponse->questions->questionid}}][response]" value="{{$caseresponse->response}}">
                        </td>
                    </tr>
                    @break

                    @case('Date')
                    <tr>
                        <td>
                            <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                        </td>
                        <td> <input type="date" aria-describedby="response" name="caseresponses[{{$caseresponse->questions->questionid}}][response]" value="{{$caseresponse->response}}">
                        </td>
                    </tr>
                    @break

                    @case('List')
                    <tr>
                        <td>
                            <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                        </td>
                        <td> <input type="text" aria-describedby="response" name="caseresponses[{{$caseresponse->questions->questionid}}][response]" value="{{$caseresponse->lookups->tag ?? ''}}" disabled="true">
                        </td>
                    </tr>
                    @break

                    @case('File')
                    <tr>
                        <td>
                            <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                        </td>
                        <td> <input type="file" aria-describedby="response" name="caseresponses[{{$caseresponse->questions->questionid}}][response]" value="{{$caseresponse->response}}" disabled="true">
                            <iframe src="{{asset('storage/'.$caseresponse->response) }}" name="caseresponses[{{$caseresponse->questions->questionid}}][response]" height="200px" width="100%" class="img_tag1"></iframe>
                        </td>
                    </tr>
                    @break

                    @default
                    <tr>
                        <td>
                            <label for="response"> {{$caseresponse->questions->questionid}} : {{$caseresponse->questions->question}}</label>
                        </td>
                        <td> <input name="response" type="text" class="form-control @error('response') is-invalid @enderror" aria-describedby="response" value="{{isset($caseresponse->response) ? $caseresponse->response : old('response')}}">
                        </td>
                    </tr>
                    @endswitch

                    @endforeach


                </tbody>
            </table>

            <div class="form-group">
            </div>


            <label for="summary">Summary</label>
            <!-- <textarea name="summary" value="{{isset($casesummary->summary) ? $casesummary->summary : old('summary')}}" rows="4" cols="50"> -->

            <textarea name="summary" value="" rows="4" cols="50" style="height: 320px;">
            {{$casesummary->summary}}
            </textarea>

            <div class="form-group">
            </div>




            <input name="getFileId" type="hidden" class="form-control" id="fileid" value="{{$fileid}}">
            <input name="getResponse" type="hidden" class="form-control" id="response" value="{{$response}}">
            <input name="getauthid" type="hidden" class="form-control" id="authid" value="{{Auth::user()->id}}">

            <div class="form-group">
                <div class="col-sm-12" style="width:100%;margin: 20px;" id="form">
                    <div id="question"></div>
                </div>
            </div>




            <button type="submit" class="btn btn-primary" onclick=checkSubmit();>Submit</button>

        </div>
    </form>
</div>







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> -->



<!-- <script src="{{ asset(config('app.publicurl')) }}/js/jquery.min.js" defer></script> -->
<!-- <script src="{{ asset(config('app.publicurl')) }}/jquery-3.5.0.js" defer></script> -->
<link rel="stylesheet" type="text/css" href="{{ asset(config('app.publicurl')) }}css/bootstrap.min.css">
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> -->



<!-- <script src="{{ asset(config('app.publicurl')) }}/js/jquery.min.js" defer></script> -->
<!-- <script src="{{ asset(config('app.publicurl')) }}/jquery-3.5.0.js" defer></script> -->
<link rel="stylesheet" type="text/css" href="{{ asset(config('app.publicurl')) }}css/bootstrap.min.css">
</link>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let lobQAGroups = [];
    let lobQA = [];
    let lobResponseQA = [];
    let lookups = [];
    var fileid;

    // select all elements 
    const form = document.getElementById("form");
    const question = document.getElementById("question");

    let lastQuestion = lobQA.length - 1;
    var currentQuestions = 0;
    var currentGroupId = 0;
    var content = "";
    var urlGetLookUps = "";

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
    });

    function getQuestions() {
        questionGroupId = lobQAGroups[0][currentGroupId].id;
        urlGetQuestions = "{{ url('/questionslobbg') }}/" + questionGroupId;
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

        $("#img_tag_" + elementId).show();

        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img_tag_' + elementId).attr('src', e.target.result);
        }

        reader.readAsDataURL($('input[id="response_' + elementId + '"]').get(0).files[0]);

        var file_data = $('input[id="response_' + elementId + '"]').get(0).files[0];
        urlGetUploadFiles = "{{ url('/fileupload') }}/" + fileid;
        var fd = new FormData();
        fd.append("file", file_data);
        fd.append("isFirst", true);
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
            },
            error: function(e) {
                console.log("ERROR : ", e);
                $("#img_tag_" + elementId).hide();
            }
        });


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






    function renderSelectOptions(elementId) {
        var qIndex = elementId.split("_")[1];
        var currentQ = elementId.split("_")[0];

        var optionsHTML = "";
        let q = lobQA[0][qIndex];
        var lookupValue = q.lookuptype;
        optionsHTML += '<option value=""> ---- Select ' + lookupValue + ' ----</option>';
        for (var val in lookups[0]) {
            if (lookupValue === lookups[0][val].type) {
                optionsHTML += '<option value="' + lookups[0][val].id + '">' + lookups[0][val].tag + '</option>';
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


    function checkResponse(elementId) {

        var response = $('#response_' + elementId).val();
        $('#response_' + elementId).attr("value", response);

        var qIndex = elementId.split("_")[1];
        var currentQ = elementId.split("_")[0];


        var nextQ = parseInt(currentQ) + 1;

        lobQA[0][qIndex].response = response;
        let q = lobQA[0][qIndex];

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





@endsection