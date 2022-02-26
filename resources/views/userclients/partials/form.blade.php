@csrf
<div class="col-12">
    <label for="userid" class="required">User Name</label>

    <select name="userid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($users as $user)
        <div class="mb-3">
            <option value="{{ $user->id }}" 
            @isset($userclient) {{  $user->id == $userclient->userid ? 'selected' : '' }} @endisset> {{ $user->name }}</option>
        </div>
        @endforeach

    </select>
</div>


<div class="col-12">
    <label for="clientid" class="required">Client</label>

    <select name="clientid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($clients as $client)
        <div class="mb-3">
            <option value="{{ $client->id }}" 
            @isset($userclient) {{  $client->id == $userclient->clientid ? 'selected' : '' }} @endisset> {{ $client->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>