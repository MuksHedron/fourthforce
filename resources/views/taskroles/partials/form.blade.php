@csrf
<div class="col-12">
    <label for="roleid" class="required">Role Name</label>

    <select name="roleid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($roles as $role)
        <div class="mb-3">
            <option value="{{ $role->id }}" @isset($taskrole) {{  $role->id == $taskrole->roleid ? 'selected' : '' }} @endisset> {{ $role->name }}</option>
        </div>
        @endforeach

    </select>
</div>
<div class="col-12">
    <label for="taskid" class="required">task Name</label>

    <select name="taskid" class="form-control">
        <option value=""> -- Select One --</option>
        @foreach($tasks as $task)
        <div class="mb-3">
            <option value="{{ $task->id }}" @isset($taskrole) {{  $task->id == $taskrole->taskid ? 'selected' : '' }} @endisset> {{ $task->name }}</option>
        </div>
        @endforeach

    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>