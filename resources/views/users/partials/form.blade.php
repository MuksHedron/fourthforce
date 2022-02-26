@csrf
<div class="form-group">
    <label for="name" class="required" >Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
    id="name" aria-describedby="name"  required
    value=" @isset($user) {{ old('name') === null ? $user->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="email" class="required" >Email address</label>
    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
     id="email" aria-describedby="email"  required
     value=" @isset($user) {{ old('email') === null ? $user->email : old('email')}}  @endisset ">
    @error('email')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="code">Code</label>
    <input name="code" type="text" class="form-control @error('code') is-invalid @enderror" id="code" aria-describedby="code" value=" @isset($user) {{ old('code') === null ? $user->code : old('code')}}  @endisset ">
    @error('code')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


    


<button type="submit" class="btn btn-primary">Submit</button>