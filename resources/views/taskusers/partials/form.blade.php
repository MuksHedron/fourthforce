@csrf
<div class="col-12">
    <label for="taskroleid" class="required">Task Name</label>

    <select name="taskroleid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($taskroles as $taskrole)
        <div class="mb-3">
            <option value="{{ $taskrole->id }}" @isset($taskuser) {{  $taskrole->id == $taskuser->taskid ? 'selected' : '' }} @endisset> {{ $taskrole->tasks->name }} </option>
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
            <option value="{{ $user->id }}" @isset($taskuser) {{  $user->id == $taskuser->userid ? 'selected' : '' }} @endisset> {{ $user->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>