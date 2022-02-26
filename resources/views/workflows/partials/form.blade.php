@csrf
<div class="form-group">
    <label for="wfstate" class="required">Work Flow State</label>
    <input name="wfstate" type="text" class="form-control @error('wfstate') is-invalid @enderror" id="wfstate" aria-describedby="wfstate" required value=" @isset($lob) {{ old('wfstate') === null ? $lob->wfstate : old('wfstate')}}  @endisset ">
    @error('wfstate')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 

<div class="form-group">
    <label for="wforder" class="required">Work Flow Order</label>
    <input name="wforder" type="text" class="form-control @error('wforder') is-invalid @enderror" id="wforder" aria-describedby="wforder" required value=" @isset($lob) {{ old('wforder') === null ? $lob->wforder : old('wforder')}}  @endisset ">
    @error('wforder')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 

<button type="submit" class="btn btn-primary">Submit</button>