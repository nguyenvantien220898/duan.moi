<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentPageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ContentPageController extends Controller
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
        $items = DB::table('content_pages')->paginate(5);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();
        $data['pages']=$items;

        return view('admin.content.content.page.index',$data);

    }

    public function create(){
        /**
         * đây là biến truyền từ controller xuống view
         */
        $data = array();

        return view('admin.content.content.page.submit',$data);
    }

    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ContentPageModel::find($id);
        $data['page']=$item;
        

        return view('admin.content.content.page.edit',$data);
    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ContentPageModel::find($id);
        $data['page']=$item;

        return view('admin.content.content.page.delete',$data);
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

        $item= new ContentPageModel();
        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->author_id =isset($input['author_id']) ? $input['author_id']:0;
        $item->view =isset($input['view']) ? $input['view']:0;
        $item->cat_id =$input['cat_id'];
        $item->intro =$input['intro'];
        $item->desc =$input['desc'];


        $item->save();

        return redirect('/admin/content/page');
    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'desc' => 'required',

        ]);

        $input=$request->all();

        $item= ContentPageModel::find($id);

        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->intro =$input['intro'];
        $item->author_id =isset($input['author_id']) ? $input['author_id']:0;
        $item->view =isset($input['view']) ? $input['view']:0;
        $item->cat_id =$input['cat_id'];
        $item->desc =$input['desc'];



        $item->save();

        return redirect('/admin/content/page');

    }

    public function destroy($id){
        $item = ContentPageModel::find($id);
        $item->delete();

        return redirect('/admin/content/page');

    }
}
