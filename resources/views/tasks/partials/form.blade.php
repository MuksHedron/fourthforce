@csrf
<div class="form-group">
    <label for="name" class="required">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($task) {{ old('name') === null ? $task->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="shortname" class="required">Short Name</label>
    <input name="shortname" type="text" class="form-control @error('shortname') is-invalid @enderror" id="shortname" aria-describedby="shortname" required value=" @isset($task) {{ old('shortname') === null ? $task->shortname : old('shortname')}}  @endisset ">
    @error('shortname')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
<div class="col-12">
    <label for="lobid" class="required">LOB</label>
    <select name="lobid" id="lobid" class="form-control" required>
        <option value=""> -- Select One --</option>
        @foreach($lobs as $lob)
        <div class="col-12">
            <option value="{{ $lob->id }}" @isset($task) {{  $lob->id ==  $task->lobid ? 'selected' : '' }} @endisset> {{ $lob->name }}</option>
        </div>
        @endforeach
    </select>
</div>

<div class="col-12">
    <label for="sublobid" class="required">Sub LOB</label>
    <select name="sublobid" id="sublobid" class="form-control" required>
        <option value=""> -- Select One --</option>
    </select>
</div>

<!-- <div class="col-12">
    <label for="sublobid" class="required">sublob Name</label>

    <select name="sublobid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($sublobs as $sublob)
        <div class="mb-3">
            <option value="{{ $sublob->id }}" @isset($task) {{  $sublob->id == $task->sublobid ? 'selected' : '' }} @endisset> {{ $sublob->name }}</option>
        </div>
        @endforeach

    </select>
</div> -->

<button type="submit" class="btn btn-primary">Submit</button>



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

                        $("#sublobid").empty();
                        $("#sublobid").append('<option>Select Sub Lob</option>');
                        $.each(res, function(key, value) {
                            $("#sublobid").append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    } else {

                        $("#sublobid").empty();
                    }
                }
            });
        } else {

            $("#sublobid").empty();
        }
    });
</script>