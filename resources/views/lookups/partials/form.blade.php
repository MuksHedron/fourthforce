@csrf
<div class="form-group">
    <label for="type" class="required">Type</label>
    <input name="type" type="text" class="form-control @error('type') is-invalid @enderror"
     id="type" aria-describedby="type" required 
     value=" @isset($lookup) {{ old('type') === null ? $lookup->type : old('type')}}  @endisset ">
    @error('type')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="tag" class="required">Tag</label>
    <input name="tag" type="text" class="form-control @error('tag') is-invalid @enderror" id="tag" aria-describedby="tag" required value=" @isset($lookup) {{ old('tag') === null ? $lookup->tag : old('tag')}}  @endisset ">
    @error('tag')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="value" class="required">Value</label>
    <input name="value" type="text" class="form-control @error('value') is-invalid @enderror" id="value" aria-describedby="value" required value=" @isset($lookup) {{ old('value') === null ? $lookup->value : old('value')}}  @endisset ">
    @error('value')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">Submit</button>