@extends('layouts.app')

@section('title')
Assign File
@endsection

@section('content')


<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Assign File</h4>
    </div>
</div>
<div class="iq-card-body">

<div class="row">
<div class="col-md-12 col-sm-12 ">
<div class="x_panel">
	<div class="x_title">
		<h2>Files <small>File Details</small></h2>
		
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br />
		
		<div class="col-md-6 col-sm-6">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>Sub LOB</td>
                                <td>{{$file->sublobs->name }}</td>
                            </tr>
                            <tr>
                                <td>Customer Reference No</td>
                                <td>{{$file->policyno }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$file->name }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$file->address }}</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>{{$file->locations->name }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$file->cities->name }}</td>
                            </tr>
                           

                            </tr>

                        </tbody>
                    </table>
</div>
<div class="col-md-6 col-sm-6">
                    <table class="table table-striped table-bordered">
                        <tbody>
                           
                            <tr>
                                <td>State</td>
                                <td>{{$file->states->name }}</td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>{{$file->pincode }}</td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>{{$file->mobile1 }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{$file->mobile2 }}</td>
                            </tr>
                            <tr>
                                <td>Mail ID</td>
                                <td>{{$file->email }}</td>
                            </tr>

                            <tr>
                                <td>Client</td>
                                <td>{{$file->clients->name ?? ''}}</td>
                            </tr>

                            <tr>

                            </tr>

                        </tbody>
                    </table>
</div>


<div class="row">
<div class="col-md-12 col-sm-12 ">
<div class="x_panel">
	<div class="x_title">
		<h2>Assign File <small></small></h2>
		
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
                    <form method="POST" action="{{route('files.updateassignfile')}}" enctype="multipart/form-data" class="row">
                        @csrf
                        <input name="getFileId" type="hidden" class="form-control" id="fileid" value="{{$file->id}}">
                        <div class="col-md-4">
                            <select id='userid' name="filteruser" class="form-control" style="width: 200px">
                                @isset($users)
                                @if($users != null)
                                <option value="">Select Users</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->users->id }}" @isset($users) @endisset>{{ $user->users->name  }} </option>
                                @endforeach
                                @endif
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id='taskid' name="filteruser" class="form-control" style="width: 200px">
                                @isset($tasks)
                                @if($tasks != null)
                                <option value="">Select tasks</option>
                                @foreach ($tasks as $task)
                                <option value="{{ $task->taskid }}" @isset($tasks) @endisset>{{ $task->tasks->name  }} </option>
                                @endforeach
                                @endif
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="assign_task" class="btn btn-primary">Assign</button>
                        </div>

                        <!--div class="form-group row mb-0" style="margin-top: 30px;">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div-->

                    </form>
					</div>
					</div>
					</div>
					</div>
					
					
					
					<div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                      
                    </p>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
						<th>#Id</th>
						<th>User</th>
						<th>Task</th>
						<th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
					  @if(count($taskassigned_list) > 0)
						@foreach($taskassigned_list as $list)
						<tr>
						<th scope="row">{{$list->id}}</th>
						<td>{{$list->users->name}}</td>
						<td>{{$list->tasks->name ?? ''}}</td>
						<td><a class="waves-effect waves-light remove-record" data-toggle="modal"  data-id="{{$list->id}}" data-target="#custom-width-modal"><i data-id="{{$list->id}}" class="fa fa-trash action_icon delete-icon delete_task"></i> </a></td>
						</tr>
						@endforeach
                        
						@else
						<tr>
						<td colspan ="4" align="center">No task assigned</td>
						</tr>
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
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"-->

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset(config('app.publicurl')) }}dashboard/js/infobox.js"></script>
<script type="text/javascript">
    




    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //$('#assign_task').click(function() {
		$(document).on('click','#assign_task',function(){

        var userid = $('#userid').val();
		var taskid = $('#taskid').val();
		var fileid = $('#fileid').val();
		if(userid == "")
		{
			alert('Please Select user!!!');
			$('#userid').focus();
		}
		else if(taskid == "")
		{
			alert('Please Select Task!!!');
			$('#taskid').focus();
			
		}
        if(userid != "" & taskid != "") {

            $.ajax({
                type: "GET",				
                url: "{{ url('assigntasktofile') }}?userid=" + userid+"&taskid=" + taskid+"&fileid=" + fileid,
				dataType:'json',
                success: function(res) {
                    if (res.status_code == "200") 
					{
						$.notifyBar({ cssClass: "success", html: res.message });
						
						setTimeout(function () {
							var url = "{{ url('assignfile') }}/"+fileid;
                    window.location.href = url;
                 }, 1500);
						

                    } else {
						$.notifyBar({ cssClass: "error", html: res.message });
                        
                    }
                }
            });
        } else {

            $("#typeid").empty();
        }
    });
	
	$(document).on('click','.delete_task',function(){

        var id = $(this).attr('data-id');
		var fileid = $('#fileid').val();
        if(id != "") {

            $.ajax({
                type: "GET",				
                url: "{{ url('delete_assigntasktofile') }}?id=" + id,
				dataType:'json',
                success: function(res) {
                    if (res.status_code == "200") 
					{
						
						$.notifyBar({ cssClass: "success", html: res.message });
						setTimeout(function () {
							var url = "{{ url('assignfile') }}/"+fileid;
                    window.location.href = url;
                 }, 1500);

                    } else {
						$.notifyBar({ cssClass: "error", html: res.message });
                        
                    }
                }
            });
        } else {

            $("#typeid").empty();
        }
    });

   


</script>

@endsection
