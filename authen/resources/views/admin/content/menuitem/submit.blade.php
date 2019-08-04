@extends('admin.layouts.glance')
@section('title')
    Danh mục nội dung
@endsection
@section('content')
    <h1>Thêm mới menu item</h1>
    <div class="row">
        <div class="form-three widget-shadow">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form name ="product" action="{{url('admin/menuitems')}}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên menu</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control1" id="focusedinput" placeholder="Default Input">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Kiểu menu item</label>
                    <div class="col-sm-8">
                        <select name="type">
                            @foreach($types as $type_id=>$type)
                            <option value="{{$type_id}}">-{{$type}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Link</label>
                    <div class="col-sm-8">
                        <input type="text" name="link" value="{{old('link')}}" class="form-control1" id="focusedinput" placeholder="Default Input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Icon</label>
                    <div class="col-sm-8">
                        <input type="text" name="icon" value="{{old('icon')}}" class="form-control1" id="focusedinput" placeholder="Default Input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Cha</label>
                    <div class="col-sm-8">
                        <select name="parent_id">
                            <option value="">Mặc định</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Thuộc menu</label>
                    <div class="col-sm-8">
                        <select name="menu_id">
                            @foreach($menus as $menu)
                            <option value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả </label>
                    <div class="col-sm-8">
                        <textarea name="desc"  id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{old('desc')}}</textarea></div>
                </div>


                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
