@csrf

<div class="col-12">
    <label for="clientstateid" class="required">Client State</label>

    <select name="clientstateid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($clientstates as $clientstate)
        <div class="mb-3">
            <option value="{{ $clientstate->states->id }}" @isset($clientstateuser) {{  $clientstate->id == $clientstateuser->clientstateid ? 'selected' : '' }} @endisset> {{ $clientstate->states->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="col-12">
    <label for="userid" class="required">User</label>

    <select name="userid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($users as $user)
        <div class="mb-3">
            <option value="{{ $user->id }}" @isset($clientstate) {{  $user->id == $clientstate->userid ? 'selected' : '' }} @endisset> {{ $user->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>