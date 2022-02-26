@csrf
<div class="form-group">
    <label for="name" class="required">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required 
    value="@isset($client) {{old('name') === null ? $client->name : old('name')}}  @endisset">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="shortname" class="required">Short Name</label>
    <input name="shortname" type="text" class="form-control @error('shortname') is-invalid @enderror" id="shortname" aria-describedby="shortname" required 
    value="@isset($client) {{old('shortname') === null ? $client->shortname : old('shortname')}}  @endisset">
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
            <option value="{{$category->id }}" @isset($client) {{$category->id == $client->categoryid ? 'selected' : '' }} @endisset> {{$category->name}}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="form-group">
    <label for="address" class="required">Address</label>
    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" required 
    value="@isset($client) {{old('address') === null ? $client->address : old('address')}}  @endisset">
    @error('address')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="pincode" class="required">Pincode</label>
    <input name="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" aria-describedby="pincode" required 
    value="@isset($client) {{old('pincode') === null ? $client->pincode : old('pincode')}}  @endisset">
    @error('pincode')
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
            <option value="{{ $city->id }}" @isset($client) {{  $city->id == $client->cityid ? 'selected' : '' }} @endisset> {{$city->name}}</option>
        </div>
        @endforeach

    </select>
</div>


<div class="col-12">
    <label for="stateid" class="required">State</label>

    <select name="stateid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($states as $state)
        <div class="mb-3">
            <option value="{{ $state->id }}" @isset($client) {{$state->id == $client->stateid ? 'selected' : '' }} @endisset> {{$state->name}}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="form-group">
    <label for="contactname" class="required">Contact Name</label>
    <input name="contactname" type="text" class="form-control @error('contactname') is-invalid @enderror" id="contactname" aria-describedby="contactname" required 
    value="@isset($client) {{old('contactname') === null ? $client->contactname : old('contactname')}}  @endisset">
    @error('contactname')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="tele1" class="required">Telephone 1</label>
    <input name="tele1" type="text" class="form-control @error('tele1') is-invalid @enderror" id="tele1" aria-describedby="tele1" required 
    value="@isset($client) {{old('tele1') === null ? $client->tele1 : old('tele1')}}  @endisset">
    @error('tele1')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="tele2" class="required">Telephone 2</label>
    <input name="tele2" type="text" class="form-control @error('tele2') is-invalid @enderror" id="tele2" aria-describedby="tele2" required 
    value="@isset($client) {{old('tele2') === null ? $client->tele2 : old('tele2')}}  @endisset">
    @error('tele2')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="email1" class="required">Email Id 1</label>
    <input name="email1" type="text" class="form-control @error('email1') is-invalid @enderror" id="email1" aria-describedby="email1" required 
    value="@isset($client) {{old('email1') === null ? $client->email1 : old('email1')}}  @endisset">
    @error('email1')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="email2" class="required">Email Id 2</label>
    <input name="email2" type="text" class="form-control @error('email2') is-invalid @enderror" id="email2" aria-describedby="email2" required 
    value="@isset($client) {{old('email2') === null ? $client->email2 : old('email2')}}  @endisset">
    @error('email2')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


<button type="submit" class="btn btn-primary">Submit</button>