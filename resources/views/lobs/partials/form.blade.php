@csrf
<div class="form-group">
    <label for="name" class="required">LOB</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($lob) {{ old('name') === null ? $lob->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="shortname" class="required">Short Name</label>
    <input name="shortname" type="text" class="form-control @error('shortname') is-invalid @enderror" id="shortname" aria-describedby="shortname" required value=" @isset($lob) {{ old('shortname') === null ? $lob->shortname : old('shortname')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 

<button type="submit" class="btn btn-primary">Submit</button>