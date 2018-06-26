@extends("adminlte::page")

@section('content_header')
    <h1>Search Licensee By Area</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="box">
            <div class="box-body">
                <form action="{{route('search-by-area-post')}}" method="POST" class="form-inline">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="area">Area: </label>
                        <input type="text" id="area" name="area" class="form-control" required>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@stop