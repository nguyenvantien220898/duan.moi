@extends('admin.layouts.glance')
@section('title')
    quản trị new letters
@endsection
@section('content')
    <h1>   quản trị newsletters</h1>
    <div style="margin: 20px 0">
        <a href="{{url('admin/newsletters/create')}}" class="btn btn-success">Thêm newsletters</a>
    </div>
    <div class="tables">
        <div class="table-responsive bs-example widget-shadow">
            <h4>Tổng Số: </h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Actions</th>


                </tr>
                </thead>
                <tbody>
                @foreach($newsletters as $newletter)
                    <tr>
                        <th scope="row">{{$newletter->id}}</th>
                        <td>{{$newletter->email}}</td>

                        <td>
                            <a href="{{url('admin/newsletters/'.$newletter->id.'/edit')}}"class="btn btn-warning">Sửa</a>
                            <a href="{{url('admin/newsletters/'.$newletter->id.'/delete')}}"class="btn btn-danger">Xóa</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $newsletters->links() }}
        </div>
    </div>
@endsection
