@csrf
<div class="form-group">
    <label for="name" class="required">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
    aria-describedby="name" required value=" @isset($state) {{ old('name') === null ? $state->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="zoneid" class="required">Zone</label>

    <select name="zoneid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($zones as $zone)
        <div class="mb-3">
            <option value="{{ $zone->id }}" @isset($state) {{  $zone->id == $state->zoneid ? 'selected' : '' }} @endisset> {{ $zone->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>