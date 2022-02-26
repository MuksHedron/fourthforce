@extends('layouts.app')

@section('title')
Create Questions
@endsection



@section('content')

<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">LOB Tasks</h4>
    </div>
</div>




<form name="frm_questions" id="frmQuestions" method="POST" action="{{route('caseresponses.caseresponse')}}" enctype="multipart/form-data">
    @csrf

    <input name="getFileId" type="hidden" class="form-control" id="fileid" value="{{$fileid}}">
    <input name="getTaskId" type="hidden" class="form-control" id="taskid" value="{{$taskid}}">
    <input name="getResponse" type="hidden" class="form-control" id="response" value="{{$response}}">
    <input name="getauthid" type="hidden" class="form-control" id="authid" value="{{Auth::user()->id}}">


    <!-- <input id= "test1"  type="file"  name= "test"  class="form-control-file"  > -->


    <span id="ajaxerror" class="alert alert-danger"></span>






    <div class="form-group">
        <div class="col-sm-12" style="width:100%;margin: 20px;" id="form">
            <div id="question"></div>
        </div>
    </div>


    <!-- <input type="submit" value="Submit"> -->
</form>



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

        $('#ajaxerror').hide();
        fileid = $('#fileid').val();
        taskid = $('#taskid').val();
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
                    auth_id: auth_id,
                    taskid: taskid
                },
                type: "GET",
                dataType: "json",
                success: function(data) {
                    lobQAGroups = data;
                    if (lobQAGroups[0].length < 1) {
                        $("#ajaxerror").html("Please check with Admin. Tasks is not assigned for you");
                        $("#ajaxerror").show();
                    }
                },
                complete: function() {
                    getLookups();
                    getQuestions();
                },
                error: function(e) {
                    console.log("ERROR : ", e);
                    $("#ajaxerror").html("Question Group got error");
                    $("#ajaxerror").show();
                }



            });
        }




        $('.img_tag').hide();
    });

    function getQuestions() {
        questionGroupId = lobQAGroups[0][currentGroupId].id;
        urlGetQuestions = "{{ url('/questionslob') }}/" + questionGroupId;

        $.ajax({
            url: urlGetQuestions,
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
            renderSubmit();
        } else if (q.taskid === lobQAGroups[0][lastgroup].id) {
            renderSubmit();
        } else {
            renderContinue();
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
            case 'DateTime':
                renderResponseHtmlElement('DateTime', id, name);
                break;
            case 'Date':
                renderResponseHtmlElement('Date', id, name);
                break;
            case 'Time':
                renderResponseHtmlElement('Time', id, name);
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
            case 'DateTime':
                content += '<input id= "response_' + elementId + '"  type="datetime-local" name="' + name + '" class="form-control ' + name + '"  autocomplete="off" onchange=checkResponse(\'' + elementId + '\');>';
                question.innerHTML += content;
                break;
            case 'Date':
                content += '<input id= "response_' + elementId + '"  type="date" name="' + name + '" class="form-control ' + name + '"  autocomplete="off" onchange=checkResponse(\'' + elementId + '\');>';
                question.innerHTML += content;
                break;
            case 'Time':
                content += '<input id= "response_' + elementId + '"  type="time" name="' + name + '" class="form-control ' + name + '"  autocomplete="off" onchange=checkResponse(\'' + elementId + '\');>';
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
        document.getElementById("frmQuestions").submit();
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

            $('*[name*=' + k + ']').css("display", "block");

        }
    }

    function disableMultiple(fromName, toName) {

        for (l = fromName; l < toName; l++) {

            // $('*[name*=' + i + ']').attr('disabled', 'disabled');

            $('*[name*=' + l + ']').css("display", "none");



        }
    }
</script>




@endsection