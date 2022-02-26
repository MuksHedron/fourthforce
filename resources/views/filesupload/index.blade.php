@extends('layouts.app')

@section('title')
List Of Cases
@endsection



@section('content')

<div class="page-title">
    <!--div class="iq-header-title">
        <h4 class="card-title">List of Cities</h4>
    </div-->
   
    <div class="title_left">
        <h3><small>List of Batches</small></h3>
    </div>
    <form action="{{route('files.index')}}">
        @include('includes.common.search')
    </form>
</div>

<div class="iq-card-body">



    

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
 @if($role=="Administrator" || $role=="CRM")
    <div class="nav navbar-right panel_toolbox">
        <a class="btn btn-success mb-3" href="{{ route('fileupload.create') }}"><i class="fa fa-plus"></i>Upload</a>
    </div>

    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <p class="text-muted font-13 m-b-30">

                                </p>
                                <table class="table table-striped table-bordered" id='fileTable'>
                                    <thead class="thead-light">
                                        <tr>

                                            <th scope="col">#Id</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Batch Number</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									@if($files->isEmpty())
									
									@else
                                        @foreach($files as $file)
                                        <tr>

                                            <td scope="row">{{$file->id}}</td>
                                            <td>{{$file->type}}</td>
                                            <td>{{$file->batch_number}}</td>                                            
                                            <td>
											@if($file->status == 3)
                                                <a class="btn btn-sm btn-primary" href="{{ url('fileupload/'.$file->id.'/show') }}" role="button">View</a>
											<a class="btn btn-sm btn-primary validate_file" href="#" role="button" data-batchid="{{ $file->id }}">Validate</a>
                                            @elseif($file->status == 1)
												<a class="btn btn-sm btn-primary validate_file" href="#" role="button" data-batchid="{{ $file->id }}">Validate</a>
											@elseif($file->status == 2)
											<a class="btn btn-sm btn-primary import" href="#" role="button" data-batchid="{{ $file->id }}">Import</a>
											@elseif($file->status == 4)
											<span   role="button" style="color:green">Imported</span>
											@endif
											</td>
											<!--td>
                                                <a class="btn btn-sm btn-primary" href="{{ url('fileupload/'.$file->id.'/show') }}" role="button">View</a>                                            
												<a class="btn btn-sm btn-primary validate" href="#" role="button" data-batchid="{{ $file->id }}">Validate</a>
											
											</td-->
                                        </tr>
                                        @endforeach
@endif

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="table-responsive iq-card-body">





    </div>
    









    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{ asset(config('app.publicurl')) }}dashboard/js/infobox.js"></script>
    <script>
        $(document).ready(function() {
            $('#fileTable').DataTable();
			
			
$(document).on('click','.validate_file',function()
{
        var batchId = $(this).attr('data-batchid');
        if (batchId) 
		{

            $.ajax({
                type: "GET",
                url: "{{ url('validateBatchfile') }}?batchId=" + batchId,
				dataType:'json',
                success: function(res) {

                    if (res.status_code == "200") 
					{
						$.notifyBar({ cssClass: "success", html: res.message });
						
						setTimeout(function () {
						location.reload();
						}, 1500);
					}
					else
					{
						$.notifyBar({ cssClass: "error", html: res.message });
					}
                }
            });
        }
});

$(document).on('click','.import',function()
{
        var batchId = $(this).attr('data-batchid');
		var type ='All';
        if (batchId) 
		{

            $.ajax({
                type: "GET",
                url: "{{ url('importBatchfile') }}?batchId=" + batchId +"&type=" + type,
				dataType:'json',
                success: function(res) {

                    if (res.status_code == "200") 
					{
						$.notifyBar({ cssClass: "success", html: res.message });
						setTimeout(function () {
						location.reload();
						}, 1500);
					}
					else
					{
						$.notifyBar({ cssClass: "error", html: res.message });
					}
                }
            });
        }
});
        });
    </script>