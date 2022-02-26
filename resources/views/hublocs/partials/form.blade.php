@csrf
 
<div class="col-12">
    <label for="hubid" class="required">Hub</label>

    <select name="hubid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($hubs as $hub)
        <div class="mb-3">
            <option value="{{ $hub->id }}" @isset($hubloc) {{  $hub->id == $hubloc->hubid ? 'selected' : '' }} @endisset> {{ $hub->name }}</option>
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
            <option value="{{ $location->id }}" @isset($hubloc) {{  $location->id == $hubloc->locationid ? 'selected' : '' }} @endisset> {{ $location->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>