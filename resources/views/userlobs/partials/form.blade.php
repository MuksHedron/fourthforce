@csrf
<div class="col-12">
    <label for="userid" class="required">User Name</label>

    <select name="userid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($users as $user)
        <div class="mb-3">
            <option value="{{ $user->id }}" 
            @isset($userlob) {{  $user->id == $userlob->userid ? 'selected' : '' }} @endisset> {{ $user->name }}</option>
        </div>
        @endforeach

    </select>
</div>


<div class="col-12">
    <label for="sublobid" class="required">Sub Lob</label>

    <select name="sublobid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($sublobs as $sublob)
        <div class="mb-3">
            <option value="{{ $sublob->id }}" 
            @isset($userlob) {{  $sublob->id == $userlob->sublobid ? 'selected' : '' }} @endisset> {{ $sublob->name }}</option>
        </div>
        @endforeach

    </select>
</div>

 

<button type="submit" class="btn btn-primary">Submit</button>