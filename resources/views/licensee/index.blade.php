@extends("layouts.inspinia")

@section('title','Licensees')

@section('menu')
    @can('view_licensee')
        <li class="active"><a href="{{route('licensee.index')}}"><i class="fa fa-id-card"></i>Licensee</a></li>
    @endcan
    @can('view_only_inspector_licensee')
        <li class="active"><a href="{{route('view-assigned-licensees')}}"><i class="fa fa-id-card"></i>Licensee</a></li>
    @endcan
    @can('view_all_inspectors')
        <li><a href="{{route('inspector.index')}}"><i class="fa fa-user"></i>Inspector</a></li>
    @endcan
@stop
@section('content')

        <div class="ibox">
            <div class="ibox-title">
                <h5>Licensee</h5>
                <div class="row">
                    <div class="container-fluid">
                        <div class="pull-right">
                            @can('create_licensee')
                                <a href="{{route('licensee.create')}}" class="btn btn-primary"><span class="fa fa-plus"></span> New</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                        <tr>
                            <th>First Name:</th>
                            <th>Last Name</th>
                            <th>Emirate Id</th>
                            <th>Date Of Birth</th>
                            <th>Area</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($licensees as $licensee)
                            <tr>
                                <td>{{$licensee->first_name}}</td>
                                <td>{{$licensee->last_name}}</td>
                                <td>{{$licensee->emirate_id}}</td>
                                <td>{{$licensee->dob}}</td>
                                <td>{{$licensee->area}}</td>
                                <td>{{$licensee->status}}</td>
                                @if($licensee->status=="3")
                                    <td>Disapproved</td>
                                @elseif($licensee->status=="4")
                                    <td>Approved</td>
                                @else
                                    <td>
                                        <nobr>
                                        @can('edit_licensee')
                                                <a href="{{route('licensee.edit',$licensee->id)}}" class="btn btn-info">Edit</a>
                                        @endcan

                                        @can('assign_inspector_to_licensee')
                                            @if(!is_null($licensee->inspector_id))
                                                <a href="{{route('inspector.edit',$licensee->inspector_id)}}" class="btn btn-success">View Inspector</a>
                                            @else
                                                <form class="form-inline" method="POST" action="{{route('licensee.assign-inspector',$licensee->id)}}">
                                                    {{csrf_field()}}
                                                    <select name="inspector_id" id="" class="form-control">
                                                        @foreach($inspectors as $inspector)
                                                            <option value="{{$inspector->id}}">{{$inspector->User->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="submit" class="btn btn-primary" value="Assign">
                                                </form>
                                                <a href="{{route('licensee.disapprove',$licensee->id)}}" class="btn btn-danger">Disapprove</a>
                                            @endif
                                        @elsecan('approve_disapprove_licensee')

                                                <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">View</button>

                                            <!-- Modal -->
                                            <div id="myModal" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content animated">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">View Licesee</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                                    <form action="{{route('licensee.approve',$licensee->id)}}" method="post" >
                                                                        {{csrf_field()}}
                                                                        <div class="form-group">
                                                                            <label class="control-label">First Name</label>
                                                                            <input disabled type="text" class="form-control" value="{{$licensee->first_name}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Last Name</label>
                                                                            <input disabled type="text" class="form-control" value="{{$licensee->last_name}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Emirate ID</label>
                                                                            <input disabled type="text" class="form-control" value="{{$licensee->emirate_id}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Area</label>
                                                                            <input disabled type="text" class="form-control" value="{{$licensee->area}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Date Of Birth</label>
                                                                            <input disabled type="date" class="form-control" value="{{$licensee->dob}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label">Remarks</label>
                                                                            <textarea name="remarks" class="form-control" >{{$licensee->remarks}}</textarea>
                                                                        </div>
                                                                        <label>Requirements</label>
                                                                        <div class="form-group">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" name="requirement_1" @if($licensee->requirement_1)checked @endif>Reqirement 1
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" name="requirement_2" @if($licensee->requirement_2)checked @endif>Reqirement 2
                                                                                </label>
                                                                            </div>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" name="requirement_3" @if($licensee->requirement_3)checked @endif>Reqirement 3
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <center>
                                                                            <input type="submit" class="btn btn-success " value="Approve">
                                                                            <a href="{{route('licensee.disapprove',$licensee->id)}}" class="btn btn-danger ">Disapprove</a>
                                                                        </center>
                                                                    </form>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        @endcan
                                        </nobr>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@stop
@section('js')

    <script>
        $('#datatable').DataTable();
        $('.modal').appendTo("body");
    </script>
@stop