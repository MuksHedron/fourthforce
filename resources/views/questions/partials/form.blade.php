@csrf

<div class="col-12">
    <label for="sublobid" class="required">Sub Lob</label>

    <select name="sublobid" class="form-control" >
        <option value=""> -- Select One --</option>
        @foreach($sublobs as $sublob)
        <div class="mb-3">
            <option value="{{ $sublob->id }}" @isset($question) {{  $sublob->id == $question->sublobid ? 'selected' : '' }} @endisset> {{ $sublob->name }}</option>
        </div>
        @endforeach

    </select>
</div>


<div class="form-group">
    <label for="questiongroup" class="required">Question Group</label>
    <input name="questiongroup" type="text" class="form-control @error('questiongroup') is-invalid @enderror" id="questiongroup" aria-describedby="questiongroup" required value=" @isset($question) {{ old('questiongroup') === null ? $question->questiongroup : old('questiongroup')}}  @endisset ">
    @error('questiongroup')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>


<div class="form-group">
    <label for="questionid" class="required">Question Id</label>
    <input name="questionid" type="text" class="form-control @error('questionid') is-invalid @enderror" id="questionid" aria-describedby="questionid" required value=" @isset($question) {{ old('questionid') === null ? $question->questionid : old('questionid')}}  @endisset ">
    @error('questionid')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="question" class="required">Question</label>
    <input name="question" type="text" class="form-control @error('question') is-invalid @enderror" id="question" aria-describedby="question" required value=" @isset($question) {{ old('question') === null ? $question->question : old('question')}}  @endisset ">
    @error('question')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="type" class="required">Type</label>
    <input name="type" type="text" class="form-control @error('type') is-invalid @enderror" id="type" aria-describedby="type" required value=" @isset($question) {{ old('type') === null ? $question->type : old('type')}}  @endisset ">
    @error('type')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="mandatory" class="required">Mandatory</label>
    <input name="mandatory" type="text" class="form-control @error('mandatory') is-invalid @enderror" id="mandatory" aria-describedby="mandatory" required value=" @isset($question) {{ old('mandatory') === null ? $question->mandatory : old('mandatory')}}  @endisset ">
    @error('mandatory')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="jumpto" class="required">Jumpto</label>
    <input name="jumpto" type="text" class="form-control @error('jumpto') is-invalid @enderror" id="jumpto" aria-describedby="jumpto" required value=" @isset($question) {{ old('jumpto') === null ? $question->jumpto : old('jumpto')}}  @endisset ">
    @error('jumpto')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary">Submit</button>