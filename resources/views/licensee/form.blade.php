@extends("adminlte::page")
@section('content_header')
    <h1>Create Licensee</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body">
                    {!! form($form) !!}
                </div>
            </div>
        </div>
    </div>
@stop