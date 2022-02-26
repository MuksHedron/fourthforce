@csrf
<div class="form-group">
    <label for="name" class="required">Sub Lob</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
    aria-describedby="name" required value=" @isset($sublob) {{ old('name') === null ? $sublob->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="shortname" class="required">Short Name</label>
    <input name="shortname" type="text" class="form-control @error('shortname') is-invalid @enderror" id="shortname" 
    aria-describedby="shortname" required 
    value=" @isset($sublob) {{ old('shortname') === null ? $sublob->shortname : old('shortname')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="lobid" class="required">Lob</label>

    <select name="lobid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($lobs as $lob)
        <div class="mb-3">
            <option value="{{ $lob->id }}" @isset($sublob) {{  $lob->id == $sublob->lobid ? 'selected' : '' }} @endisset> {{ $lob->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>