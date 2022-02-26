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

<div class="col-12">
    <label for="locationid" class="required">Location</label>

    <select name="locationid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($locations as $location)
        <div class="mb-3">
            <option value="{{ $location->id }}" @isset($userloc) {{  $location->id == $userloc->locationid ? 'selected' : '' }} @endisset> {{ $location->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>