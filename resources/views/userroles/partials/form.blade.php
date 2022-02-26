@csrf

<div class="col-12">
    <label for="usersid" class="required">User</label>

    <select name="usersid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($users as $user)
        <div class="mb-3">
            <option value="{{ $user->id }}" @isset($userrole) {{  $user->id == $userrole->usersid ? 'selected' : '' }} @endisset> {{ $user->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="col-12">
    <label for="roleid" class="required">Role</label>

    <select name="roleid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($roles as $role)
        <div class="mb-3">
            <option value="{{ $role->id }}" @isset($userrole) {{  $role->id == $userrole->roleid ? 'selected' : '' }} @endisset> {{ $role->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>