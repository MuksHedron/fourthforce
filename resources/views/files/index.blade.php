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



    @if($files->isEmpty())
    <div class="alert alert-warning">
        The list of Files is empty
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
 @if($role=="Administrator" || $role=="CRM")
    <div class="nav navbar-right panel_toolbox">
        <a class="btn btn-success mb-3" href="{{ route('files.create') }}"><i class="fa fa-plus"></i>Create</a>
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
                                            <th scope="col">Case Status</th>
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
                                            <td>{{$file->address ?? ''}}</td>
                                            <td>{{$file->locations->name ?? ''}}</td>
                                            <td>{{$file->cities->name ?? ''}}</td>
                                            <td>{{$file->states->name ?? ''}}</td>
                                            <td>{{$file->pincode ?? ''}}</td>
                                            <td>{{$file->mobile1 ?? ''}}</td>
                                            <td>{{$file->lookups->tag ?? ''}}</td>
                                            @if($role!="CRM")
                                            <td>
                                                <!-- <a class="btn btn-sm btn-primary" href="{{ route('files.edit', $file->id) }}" role="button">Edit File</a> -->

                                                @if($role=="CVO" || $role=="TVO" || $role=="Vendor")
                                                <a class="btn btn-sm btn-primary" href="{{ route('questionslob',['id' => $file->id,'taskid' => $file->taskid ] ) }}" role="button">Go To</a>
                                                @endif


                                                @if($role=="Processor" || $role=="QC")
                                                <a class="btn btn-sm btn-success" href="{{ route('casetrackers.editcasetrackers',['id' => $file->id]) }}" role="button">{{$file->lookups->tag ?? ''}}</a>
                                                <a class="btn btn-sm btn-secondary" href="{{ route('casetrackers.updatecasetrackersreturn',['id' => $file->id]) }}" role="button">Return</a>
                                                @endif

                                                @if(($role=="Assignor" || $role=="Administrator") && ($file->filestatusid==47 || $file->filestatusid==62 || $file->filestatusid==65 ))
                                                <a class="btn btn-sm btn-primary" href="{{ route('files.assignfile',['id' => $file->id]) }}" role="button">Go to</a>
                                                @endif


                                                <!-- @if($file->filestatus!=47 )
                    <a class="btn btn-sm btn-primary" href="{{ route('caseresponses.editcaseresponses',['id' => $file->id]) }}" role="button">Edit Response</a>
                    @endif -->

                                                <!-- <a class="btn btn-sm btn-primary" href="{{ route('casetrackers.editcasetrackers',['id' => $file->id]) }}" role="button" >{{$file->lookups->tag ?? ''}}</a> -->
                                                @if((trim($role)!="CVO") &&(trim($role)!="TVO") && (trim($role)!="Vendor"))
                                                <a class="btn btn-sm btn-primary" href="{{ url('files/'.$file->id.'/edit') }}" role="button">Edit</a>
                                                @endif

                                            </td>

                                            @endif

                                            @if($role=="CRM")
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{ url('files/'.$file->id.'/edit') }}" role="button">Edit</a>
                                            </td>
                                            @endif
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

    <div class="table-responsive iq-card-body">





    </div>
    @endif









    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        $(document).ready(function() {
            $('#fileTable').DataTable();
        });
    </script>