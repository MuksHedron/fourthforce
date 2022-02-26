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
        <h3><small>List of Files</small></h3>
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
 @if($role=="Administrator" || $role=="CRM")
    <div class="nav navbar-right panel_toolbox">
        <a class="btn btn-success mb-3" style="float:left" href="{{ url('fileupload') }}">Back</a>
        <a class="btn btn-success mb-3 import" href="#" data-batchid="{{ $batchId }}">Import Valid files</a>
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
                                            @if($role=="CVO" || $role=="TVO" || $role=="Vendor")
                                            <th scope="col">Task Name</th>
                                            @endif
                                            <th scope="col">Customer Reference No</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">City</th>
                                            <th scope="col">State</th>
                                            <th scope="col">Pincode</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Status</th>                                            
                                            <th scope="col">Errors</th>                                            
                                            <th scope="col">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									@if($files->isEmpty())
									
									@else
                                        @foreach($files as $file)
                                        <tr>

                                            <td scope="row">{{$file->id}}</td>
                                            <td>{{$file->sublobs->name ?? ''}}</td>
                                            @if($role=="CVO" || $role=="TVO" || $role=="Vendor")
                                            <td>{{$file->taskname ?? ''}}</td>
                                            @endif
                                            <td>{{$file->policyno ?? ''}}</td>
                                            <td>{{$file->name ?? ''}}</td>
                                            <td>{{$file->address ?? ''}}</td>
                                            <td>{{$file->locations->name ?? ''}}</td>
                                            <td>{{$file->cities->name ?? ''}}</td>
                                            <td>{{$file->states->name ?? ''}}</td>
                                            <td>{{$file->pincode ?? ''}}</td>
                                            <td>{{$file->mobile1 ?? ''}}</td>
                                            <td>
											@if($file->upload_status == 1)
												<span> yet to be Validated</span>
											@elseif($file->upload_status == 2)
											<span style="color:green"> Valid</span>
											@elseif($file->upload_status == 3)
											<span style="color:red"> Error</span>
											@endif
											</td>
                                            
<td style="color:red">{{ $file->error_msg }}</td>
                                            
                                            <td>
											@if($file->upload_status == 3)
                                                <a class="btn btn-sm btn-primary" href="{{ url('fileupload/'.$file->id.'/edit') }}" role="button">Edit</a>
											@endif                                          
										   </td>
                                            
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
			var fileupload = <?php echo $files_json; ?>;
			var obj = (fileupload);console.log(obj);
			$.each(obj, function(key,value) 
			{
			 // alert(value.id);
			}); 
			
			$(document).on('click','.import',function()
{
        var batchId = $(this).attr('data-batchid');
		var type ='Valid';
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