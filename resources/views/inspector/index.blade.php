@extends("adminlte::page")

@section('content_header')
    <h1>Inspectors</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="box">

            <div class="box-body">
                <div class="row">
                    <div class="container-fluid">
                        <div class="pull-right">
                            <a href="{{route('inspector.create')}}" class="btn btn-primary"><span class="fa fa-plus"></span> New</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name:</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inspectors as $inspector)
                            <tr>
                                <td>{{$inspector->User->name}}</td>
                                <td>{{$inspector->User->email}}</td>
                                <td>{{$inspector->contact}}</td>
                                <td><a href="{{route('inspector.view-licensees',$inspector->id)}}">View Licensees</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop