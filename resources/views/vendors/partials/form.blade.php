@csrf
<div class="form-group">
    <label for="name" class="required">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($vendor) {{ old('name') === null ? $vendor->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>



<div class="form-group">
    <label for="shortname" class="required">Short Name</label>
    <input name="shortname" type="text" class="form-control @error('shortname') is-invalid @enderror" id="shortname" aria-describedby="shortname" required value=" @isset($vendor) {{ old('shortname') === null ? $vendor->shortname : old('shortname')}}  @endisset ">
    @error('shortname')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 

<div class="form-group">
    <label for="contact" class="required">Contact</label>
    <input name="contact" type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" aria-describedby="contact" required value=" @isset($vendor) {{ old('contact') === null ? $vendor->contact : old('contact')}}  @endisset ">
    @error('contact')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 

<div class="form-group">
    <label for="email" class="required">Email ID</label>
    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" required value=" @isset($vendor) {{ old('email') === null ? $vendor->email : old('email')}}  @endisset ">
    @error('email')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 

<div class="form-group">
    <label for="mobile" class="required">Mobile No</label>
    <input name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" aria-describedby="mobile" required value=" @isset($vendor) {{ old('mobile') === null ? $vendor->mobile : old('mobile')}}  @endisset ">
    @error('mobile')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 

<div class="form-group">
    <label for="address" class="required">Address</label>
    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" aria-describedby="address" required value=" @isset($vendor) {{ old('address') === null ? $vendor->address : old('address')}}  @endisset ">
    @error('address')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div> 


<div class="form-group">
    <label for="pincode" class="required">Pincode</label>
    <input name="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" aria-describedby="pincode" required value=" @isset($vendor) {{ old('pincode') === null ? $vendor->pincode : old('pincode')}}  @endisset ">
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
            <option value="{{ $city->id }}" @isset($vendor) {{  $city->id == $vendor->cityid ? 'selected' : '' }} @endisset> {{ $city->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>