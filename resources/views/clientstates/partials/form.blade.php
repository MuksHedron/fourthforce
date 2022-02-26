@csrf
 

<div class="col-12">
    <label for="clientid" class="required">Client</label>

    <select name="clientid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($clients as $client)
        <div class="mb-3">
            <option value="{{ $client->id }}" @isset($clientstate) {{  $client->id == $clientstate->clientid ? 'selected' : '' }} @endisset> {{ $client->name }}</option>
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
            <option value="{{ $state->id }}" @isset($clientstate) {{  $state->id == $clientstate->stateid ? 'selected' : '' }} @endisset> {{ $state->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>