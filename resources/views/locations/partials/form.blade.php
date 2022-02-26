@csrf
<div class="form-group">
    <label for="name" class="required">Location</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($location) {{ old('name') === null ? $location->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="cityid" class="required">City</label>

    <select name="cityid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($cities as $city)
        <div class="mb-3">
            <option value="{{ $city->id }}" @isset($location) {{  $city->id == $location->cityid ? 'selected' : '' }} @endisset> {{ $city->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>