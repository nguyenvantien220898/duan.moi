@extends('admin.layouts.glance')

@section('title')
    Xóa banner
@endsection
@section('content')
    <h1>Xóa banner: {{$banner->id.' : '.$banner->name}}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="banner" action="{{url('admin/banners/'.$banner->id.'/delete')}}" method="post" class="form-horizontal">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>

@endsection
