@csrf
<div class="form-group">
    <label for="name" class="required">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($hub) {{ old('name') === null ? $hub->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="col-12">
    <label for="categoryid" class="required">Category</label>

    <select name="categoryid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($categories as $category)
        <div class="mb-3">
            <option value="{{ $category->id }}" @isset($hub) {{  $category->id == $hub->categoryid? 'selected' : '' }} @endisset> {{ $category->name }}</option>
        </div>
        @endforeach

    </select>
</div>

 
<div class="col-12">
    <label for="cityid" class="required">City</label>

    <select name="cityid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($cities as $city)
        <div class="mb-3">
            <option value="{{ $city->id }}" @isset($hub) {{  $city->id == $hub->cityid ? 'selected' : '' }} @endisset> {{ $city->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>