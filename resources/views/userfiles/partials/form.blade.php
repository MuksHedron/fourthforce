@csrf

<div class="col-12">
    <label for="fileid" class="required">Case Customer Reference No</label>

    <select name="fileid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($files as $file)
        <div class="mb-3">
            <option value="{{ $file->id }}" @isset($userfile) {{  $file->id == $userfile->fileid ? 'selected' : '' }} @endisset> {{ $file->policyno }}</option>
        </div>
        @endforeach

    </select>
</div>

<div class="col-12">
    <label for="userid" class="required">User Name</label>

    <select name="userid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($users as $user)
        <div class="mb-3">
            <option value="{{ $user->id }}" @isset($userfile) {{  $user->id == $userfile->userid ? 'selected' : '' }} @endisset> {{ $user->name }}</option>
        </div>
        @endforeach

    </select>
</div>



<button type="submit" class="btn btn-primary">Submit</button>