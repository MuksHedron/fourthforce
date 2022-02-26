@csrf
<div class="form-group">
    <label for="name" class="required">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($area) {{ old('name') === null ? $area->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="locationid" class="required">Location Name</label>

    <select name="locationid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($locations as $location)
        <div class="mb-3">
            <option value="{{ $location->id }}" @isset($area) {{  $location->id == $area->locationid ? 'selected' : '' }} @endisset> {{ $location->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>