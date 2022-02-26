@extends('layouts.app')

@section('title')
List of Cities
@endsection

@section('content')

<style>
.action_icon
{
	float:inherit !important;
}
</style>
<div class="page-title">
    <!--div class="iq-header-title">
        <h4 class="card-title">List of Cities</h4>
    </div-->
	
	<div class="title_left">
	<h3><small>List of Cities</small></h3>
  </div>


<form action="{{route('cities.index')}}">
    @include('includes.common.search')
</form>
</div>

<div class="iq-card-body">

    

    @if($citiesdata->isEmpty())
    <div class="alert alert-warning">
        The list of cities is empty
    </div>
    @else
		
	<div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <!--h2>List of cities <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul-->
					<div class="nav navbar-right panel_toolbox">
					<a class="btn btn-success mb-3" href="{{ route('cities.create') }}"><i class="fa fa-plus"></i>Create</a>
					</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                      
                    </p>
                    <table id="example1" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
						<th>#Id</th>
						<th>City</th>
						<th>State</th>
						<th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
						@foreach($citiesdata as $city)
						<tr>
						<th scope="row">{{$city->id}}</th>
						<td>{{$city->name}}</td>
						<td>{{$city->states->name ?? ''}}</td>

						<td>

						<a href="{{ route('cities.edit', $city->id) }}" class=""><i class="fa fa-edit action_icon edit-icon"></i></a>	
						<a class="waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ route('cities.destroy',$city->id)  }}" data-id="{{$city->id}}" data-target="#custom-width-modal"><i class="fa fa-trash action_icon delete-icon"></i> </a>

						</td>

						</tr>
						@endforeach
                        
                      </tbody>
                    </table>
					
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>


            </div>
	
   


    @endif
    @endsection
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
$(document).ready(function() {
	$('#example1').DataTable();
	
});
</script>
