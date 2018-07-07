@extends("layouts.inspinia")
@section('title','Create Inspector')
@section('menu')
    @can('view_licensee')
        <li ><a href="{{route('licensee.index')}}"><i class="fa fa-id-card"></i><span class="nav-label">Licensee</span></a></li>
    @endcan
    @can('view_only_inspector_licensee')
        <li ><a href="{{route('view-assigned-licensees')}}"><i class="fa fa-id-card"></i><span class="nav-label">Licensee</span></a></li>
    @endcan
    @can('view_all_inspectors')
        <li class="active"><a href="{{route('inspector.index')}}"><i class="fa fa-user"></i><span class="nav-label">Inspector</span></a></li>
    @endcan
@stop
@section('content')

        <div class="col-md-6">
            <div class="ibox ">
                <div class="ibox-content">
                    {!! form($form) !!}
                </div>
            </div>
        </div>
@stop