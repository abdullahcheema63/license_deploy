@extends("adminlte::page")

@section('content_header')
    <h1>Licensees</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="box">

            <div class="box-body">
                <div class="row">
                    <div class="container-fluid">
                        <div class="pull-right">
                            <a href="{{route('licensee.create')}}" class="btn btn-primary"><span class="fa fa-plus"></span> New</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>First Name:</th>
                            <th>Last Name</th>
                            <th>Emirate Id</th>
                            <th>Date Of Birth</th>
                            <th>Area</th>
                            <th>Status</th>
                            <th>Inspector</th>
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
                                <td>
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
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop