@extends('layouts.app')

@section('title')
List of Categories
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">List of Categories</h4>
    </div>
</div>

<form action="{{route('categories.index')}}">
    @include('includes.common.search')
</form>


<div class="iq-card-body">

    <a class="btn btn-success mb-3" href="{{ route('categories.create') }}">Create</a>

    @if($categories->isEmpty())
    <div class="alert alert-warning">
        The list of categories is empty
    </div>
    @else
    <div class="table-responsive iq-card-body">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Category</th> 
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td> 
                    <td>

                        <a class="btn btn-sm btn-primary" href="{{ route('categories.edit', $category->id) }}" role="button">Edit</a>

                        <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('categories.destroy',$category->id)  }}" data-id="{{$category->id}}" data-target="#custom-width-modal">Delete</a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}


    </div>


    @endif
    @endsection