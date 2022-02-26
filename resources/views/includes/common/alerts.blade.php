<div class="container-fluid">
    @if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger">
        <ul>
            {{session('error')}}
        </ul>
    </div>
    @endif

</div>