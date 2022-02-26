@csrf
<div class="form-group">
    <label for="name" class="required">Role</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" required value=" @isset($role) {{ old('name') === null ? $role->name : old('name')}}  @endisset ">
    @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="level" class="required">level</label>
    <input name="level" type="text" class="form-control @error('level') is-invalid @enderror" id="level" 
    aria-describedby="level" required value=" @isset($role) {{ old('level') === null ? $role->level : old('level')}}  @endisset ">
    @error('level')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>
 

<button type="submit" class="btn btn-primary">Submit</button>