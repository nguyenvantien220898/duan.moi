<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ContentCategoryController extends Controller
{
    //
    /*
    * Hàm khơi tạo của class được chạy nhau khi khởi tạo đối tượng
    * Hàm này nó luôn được chạy trước các hàm khác trong class
    * admincontroller contructor
    */
    public  function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){

        $items = DB::table('content_category')->paginate(5);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();
        $data['cats']=$items;

        return view('admin.content.content.category.index',$data);
    }

    public function create(){
        /**
         * đây là biến truyền từ controller xuống view
         */
        $data = array();


        return view('admin.content.content.category.submit',$data);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input=$request->all();
        $item= new ContentCategoryModel();

        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->intro =$input['intro'];
        $item->desc =$input['desc'];
        $item->save();

        return redirect('/admin/content/category');
    }

    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ContentCategoryModel::find($id);
        $data['cat']=$item;
        return view('admin.content.content.category.edit',$data);

    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ContentCategoryModel::find($id);
        $data['cat']=$item;

        return view('admin.content.content.category.delete',$data);
    }
    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input=$request->all();
        $item= ContentCategoryModel::find($id);

        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->intro =$input['intro'];
        $item->desc =$input['desc'];
        $item->save();

        return redirect('/admin/content/category');

    }

    public function destroy($id){
        $item = ContentCategoryModel::find($id);
        $item->delete();

        return redirect('/admin/content/category');

    }
}
