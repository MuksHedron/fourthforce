@csrf
<div class="col-12">
    <label for="usersid" class="required">User Name</label>

    <select name="usersid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($users as $user)
        <div class="mb-3">
            <option value="{{ $user->id }}" 
            @isset($userloc) {{  $user->id == $userloc->usersid ? 'selected' : '' }} @endisset> {{ $user->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>