<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentTagModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ContentTagController extends Controller
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
        $items = DB::table('content_tags')->paginate(5);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();
        $data['tags']=$items;

        return view('admin.content.content.tag.index',$data);

    }

    public function create(){
        /**
         * đây là biến truyền từ controller xuống view
         */
        $data = array();

        return view('admin.content.content.tag.submit',$data);
    }

    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ContentTagModel::find($id);
        $data['tag']=$item;


        return view('admin.content.content.tag.edit',$data);
    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ContentTagModel::find($id);
        $data['tag']=$item;

        return view('admin.content.content.tag.delete',$data);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'intro' => 'required',


        ]);

        $input=$request->all();

        $item= new ContentTagModel();
        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->author_id =isset($input['author_id']) ? $input['author_id']:0;
        $item->view =isset($input['view']) ? $input['view']:0;
        $item->intro =$input['intro'];



        $item->save();

        return redirect('/admin/content/tag');
    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',


        ]);

        $input=$request->all();

        $item= ContentTagModel::find($id);

        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->intro =$input['intro'];
        $item->author_id =isset($input['author_id']) ? $input['author_id']:0;
        $item->view =isset($input['view']) ? $input['view']:0;



        $item->save();

        return redirect('/admin/content/tag');

    }

    public function destroy($id){
        $item = ContentTagModel::find($id);
        $item->delete();

        return redirect('/admin/content/tag');

    }
}
