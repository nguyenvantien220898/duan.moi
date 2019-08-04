<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\MenuItemModel;
use App\Model\Admin\MenuModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class MenuItemController extends Controller
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
        $items = DB::table('menu_items')->paginate(5);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();
        $data['menuitems']=$items;

        return view('admin.content.menuitem.index',$data);

    }

    public function create(){
        /**
         * đây là biến truyền từ controller xuống view
         */
        $data = array();

        $data['types'] = MenuItemModel::getTypeOfMenuItem();

        $data['menus'] = MenuModel::all();

        return view('admin.content.menuitem.submit',$data);
    }

    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=MenuItemModel::find($id);
        $data['menu']=$item;


        return view('admin.content.menuitem.edit',$data);
    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=MenuItemModel::find($id);
        $data['menu']=$item;

        return view('admin.content.menuitem.delete',$data);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'desc' => 'required',
            'menu_id' => 'required',


        ]);

        $input=$request->all();

        $item= new MenuItemModel();

        $item->name =$input['name'];
        $item->type =isset($input['type']) ? $input['type']:0;
        $item->params =isset($input['params']) ? $input['params']:0;
        $item->link =isset($input['link']) ? $input['link']:0;
        $item->desc =$input['desc'];
        $item->icon =isset($input['icon']) ? $input['icon']:0;
        $item->menu_id =isset($input['menu_id']) ? $input['menu_id']:0;
        $item->parent_id =isset($input['parent_id']) ? $input['parent_id']:0;



        $item->save();

        return redirect('/admin/menu');
    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'desc' => 'required',
            'menu_id' => 'required',



        ]);

        $input=$request->all();

        $item= MenuItemModel::find($id);

        $item->name =$input['name'];
        $item->type =isset($input['type']) ? $input['type']:0;
        $item->params =isset($input['params']) ? $input['params']:0;
        $item->link =isset($input['link']) ? $input['link']:0;
        $item->desc =$input['desc'];
        $item->icon =isset($input['icon']) ? $input['icon']:0;
        $item->menu_id =isset($input['menu_id']) ? $input['menu_id']:0;
        $item->parent_id =isset($input['parent_id']) ? $input['parent_id']:0;


        $item->save();

        return redirect('/admin/menu');

    }

    public function destroy($id){
        $item = MenuItemModel::find($id);
        $item->delete();

        return redirect('/admin/menu');

    }
}
