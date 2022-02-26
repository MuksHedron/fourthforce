@csrf
<div class="form-group">
    <label for="name" class="required">Zone</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($zone) {{ old('name') === null ? $zone->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
 

<button type="submit" class="btn btn-primary">Submit</button>