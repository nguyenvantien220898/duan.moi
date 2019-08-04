<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ShopCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\ShopProductModel;



class ShopProductController extends Controller
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
        $items = DB::table('shop_products')->paginate(5);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();
        $data['products']=$items;

        return view('admin.content.shop.product.index',$data);

    }

    public function create(){
        /**
         * đây là biến truyền từ controller xuống view
         */
        $data = array();

        $cats = ShopCategoryModel::all();
        $data['cats']=$cats;

        return view('admin.content.shop.product.submit',$data);
    }

    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ShopProductModel::find($id);
        $data['product']=$item;

        $cats = ShopCategoryModel::all();
        $data['cats']=$cats;

        return view('admin.content.shop.product.edit',$data);
    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();

        $item=ShopProductModel::find($id);
        $data['product']=$item;

        return view('admin.content.shop.product.delete',$data);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'priceCore' => 'required|numeric',
            'priceSale' => 'required|numeric',
            'stock' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input=$request->all();

        $item= new ShopProductModel();
        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->intro =$input['intro'];
        $item->desc =$input['desc'];
        $item->priceCore =$input['priceCore'];
        $item->priceSale =$input['priceSale'];
        $item->stock =$input['stock'];
        $item->cat_id =$input['cat_id'];


        $item->save();

        return redirect('/admin/shop/product');
    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'priceCore' => 'required',
            'priceSale' => 'required',
            'stock' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input=$request->all();

        $item= ShopProductModel::find($id);

        $item->name =$input['name'];
        $item->slug =$input['slug'];
        $item->images =$input['images'];
        $item->intro =$input['intro'];
        $item->desc =$input['desc'];
        $item->priceCore =$input['priceCore'];
        $item->priceSale =$input['priceSale'];
        $item->stock =$input['stock'];
        $item->cat_id =$input['cat_id'];

        $item->save();

        return redirect('/admin/shop/product');

    }

    public function destroy($id){
        $item = ShopProductModel::find($id);
        $item->delete();

        return redirect('/admin/shop/product');

    }
}
