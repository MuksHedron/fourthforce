@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-20">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}


                    <div class="row">
                            <!--div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Cases</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between"><span style="font-size:32px">{{$files->count()}}</span>
                                        <a class="small text-white stretched-link" href="{{route('files.index')}}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div -->
							
							
							<div class="row" style="display: inline-block;" >
          <div class="tile_count">
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Cases</span>
              <div class="count green">{{$files->count()}}</div>
             <span class="count_bottom"><i class="green"></i><a class="small  stretched-link" href="{{route('files.index')}}">  View Details </a></span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Today Cases</span>
              <div class="count">{{ $today_cases }}</div>
              <span class="count_bottom"><i class="green"></i><a class="small  stretched-link" href="{{route('files.index')}}">  View Details </a></span>
            </div>
            <!--div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div-->
          </div>
        </div>
                           




                        </div>
						
						
						
						
						
						<div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cases<small>Current week</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="lineChart"></canvas>
                  </div>
                </div>
              </div>

              
            </div>
						
						
						
						
						


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>

                       






                        <div class="card-body">


                            @if($files->isEmpty())
                            <div class="alert alert-warning">
                                The list of files is empty
                            </div>
                            @else
                            <div class="table-responsive iq-card-body">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>

                                            <th scope="col">#Id</th>
                                            <th scope="col">Type</th>
                                            @if($role=="CVO" || $role=="TVO" || $role=="Vendor")
                                            <th scope="col">Task Name</th>
                                            @endif
                                            <th scope="col">Customer Reference No</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">City</th>
                                            <th scope="col">State</th>

                                            <th scope="col">File Status</th>
                                            @if($role!="CRM")
                                            <th scope="col">Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($files as $file)
                                        <tr>

                                            <td scope="row">{{$file->id}}</td>
                                            <td>{{$file->sublobs->name ?? ''}}</td>
                                            @if($role=="CVO" || $role=="TVO" || $role=="Vendor")
                                            <td>{{$file->taskname ?? ''}}</td>
                                            @endif
                                            <td>{{$file->policyno ?? ''}}</td>
                                            <td>{{$file->name ?? ''}}</td>
                                            <td>{{$file->locations->name ?? ''}}</td>
                                            <td>{{$file->cities->name ?? ''}}</td>
                                            <td>{{$file->states->name ?? ''}}</td>
                                            <td>{{$file->lookups->tag ?? ''}}</td>
                                            @if($role!="CRM")
                                            <td>
                                                <!-- <a class="btn btn-sm btn-primary" href="{{ route('files.edit', $file->id) }}" role="button">Edit File</a> -->

                                                @if(($role=="CVO" || $role=="TVO" || $role=="Vendor"))
                                                <!-- <a class="btn btn-sm btn-primary" href="{{ route('questionslob',['id' => $file->id] ) }}" role="button">Go To</a> -->
                                                <a class="btn btn-sm btn-primary" href="{{ route('questionslob',['id' => $file->id,'taskid' => $file->taskid ] ) }}" role="button">Go To</a>
                                                @endif


                                                @if($role=="Processor" || $role=="QC")
                                                <a class="btn btn-sm btn-primary" href="{{ route('casetrackers.editcasetrackers',['id' => $file->id]) }}" role="button">{{$file->lookups->tag ?? ''}}</a>

                                                <a class="btn btn-sm btn-primary" href="{{ route('casetrackers.updatecasetrackersreturn',['id' => $file->id]) }}" role="button">Return</a>

                                                @endif

                                                @if(($role=="Assignor" || $role=="Administrator") && ($file->filestatusid==47 || $file->filestatusid==62 || $file->filestatusid==65 ))
                                                <a class="btn btn-sm btn-primary" href="{{ route('files.assignfile',['id' => $file->id]) }}" role="button">Assign</a>
                                                @endif



                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>


                                @if ($files->links()->paginator->hasPages())
                                <div class="d-felx justify-content-center">
                                    {{ $files->links() }}
                                </div>
                                @endif
                            </div>

                            @endif
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	/*var chartData = "{{ json_encode($week_cases) }}";*/
	var chartData = {!! json_encode($week_cases, JSON_HEX_TAG) !!};
	var weekdays = {!! json_encode($week_days, JSON_HEX_TAG) !!};
	var case_counts = {!! json_encode($case_counts, JSON_HEX_TAG) !!};
	/*console.log(weekdays);*/
	console.log(chartData);
	var dt = new Date()  //current date of week
var currentWeekDay = dt.getDay();
var lessDays = currentWeekDay == 0 ? 6 : currentWeekDay-1
var startOfWeek = new Date(new Date(dt).setDate(dt.getDate()- lessDays));
	
	
	
	if ($("#lineChart").length) {
            var e = document.getElementById("lineChart");
            new Chart(e, {
                type: "line",
                data: {
                    labels: weekdays,
                    datasets: [{
                        label: "My First dataset",
                        backgroundColor: "rgba(38, 185, 154, 0.31)",
                        borderColor: "rgba(38, 185, 154, 0.7)",
                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointBorderWidth: 1,
                        data: case_counts
                    }]
                }
            })
        }
	});
</script>
