@extends("layouts.inspinia")

@section('title','Inspectors')

@section('menu')
    @can('view_licensee')
        <li ><a href="{{route('licensee.index')}}"><i class="fa fa-id-card"></i>Licensee</a></li>
    @endcan
    @can('view_only_inspector_licensee')
        <li ><a href="{{route('view-assigned-licensees')}}"><i class="fa fa-id-card"></i>Licensee</a></li>
    @endcan
    @can('view_all_inspectors')
        <li class="active"><a href="{{route('inspector.index')}}"><i class="fa fa-user"></i>Inspector</a></li>
    @endcan
@stop
@section('content')

        <div class="ibox">
            <div class="ibox-title">
                <div class="row">
                    <div class="container-fluid">
                        <div class="pull-right">
                            <a href="{{route('inspector.create')}}" class="btn btn-primary"><span class="fa fa-plus"></span> New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table" id="datatable">
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
                                <td><a class="btn btn-info" href="{{route('inspector.view-licensees',$inspector->id)}}">View Licensees</a></td>
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
    </script>
@stop