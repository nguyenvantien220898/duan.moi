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
        $items = DB::table('shop_products')->paginate(9);

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

    public function slugify($str){
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ã|ả|â|ầ|ấ|ậ|ẫ|ẩ|ă|ằ|ắ|ẵ|ặ|ẳ)/','a',$str);
        $str = preg_replace('/(è|é|ẹ|ẽ|ẻ|ê|ề|ế|ể|ễ|ệ)/','e',$str);
        $str = preg_replace('/(ì|í|ĩ|ỉ|ị)/','i',$str);
        $str = preg_replace('/(ò|ó|ỏ|õ|ọ|ô|ồ|ố|ổ|ỗ|ộ|ơ|ờ|ớ|ở|ỡ|ỡ)/','o',$str);
        $str = preg_replace('/(ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ử|ữ|ự)/','u',$str);
        $str = preg_replace('/(ý|ỳ|ỷ|ỹ|ỵ)/','y',$str);
        $str = preg_replace('/(đ)/','d',$str);
        $str = preg_replace('/[^a-z0-9-\s]/','',$str);
        $str = preg_replace('/([\s]+)/','-',$str);
        return $str;
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'images' => 'required',
            'priceCore' => 'required|numeric',
            'priceSale' => 'required|numeric',

        ]);

        $input=$request->all();

        $item= new ShopProductModel();
        $item->name =$input['name'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->images =isset($input['images'])? json_encode($input['images']) : '';
        $item->intro =isset($input['intro']) ? $input['intro'] : '' ;
        $item->desc =isset($input['desc']) ? $input['desc'] : '';
        $item->ship_info =isset($input['ship_info']) ? $input['ship_info'] : '';
        $item->additional_information =isset($input['additional_information']) ? $input['additional_information'] : '';
        $item->review =isset($input['review']) ? $input['review'] : '';
        $item->help =isset($input['help']) ? $input['help'] : '';
        $item->priceCore =$input['priceCore'];
        $item->priceSale =$input['priceSale'];
        $item->stock =isset($input['stock']) ? (int) $input['stock'] : 0;
        $item->cat_id =$input['cat_id'];
        $item->homepage =isset($input['homepage']) ? (int)$input['homepage'] : 0;



        $item->save();

        return redirect('/admin/shop/product');
    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'images' => 'required',
            'priceCore' => 'required|numeric',
            'priceSale' => 'required|numeric',
        ]);

        $input=$request->all();

        $item= ShopProductModel::find($id);


        $item->name =$input['name'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->images =isset($input['images'])? json_encode($input['images']) : '';
        $item->intro =isset($input['intro']) ? $input['intro'] : '' ;
        $item->desc =isset($input['desc']) ? $input['desc'] : '';
        $item->ship_info =isset($input['ship_info']) ? $input['ship_info'] : '';
        $item->additional_information =isset($input['additional_information']) ? $input['additional_information'] : '';
        $item->review =isset($input['review']) ? $input['review'] : '';
        $item->help =isset($input['help']) ? $input['help'] : '';
        $item->priceCore =$input['priceCore'];
        $item->priceSale =$input['priceSale'];
        $item->stock =isset($input['stock']) ? (int) $input['stock'] : 0;
        $item->cat_id =$input['cat_id'];
        $item->homepage =isset($input['homepage']) ? (int)$input['homepage'] : 0;


        $item->save();

        return redirect('/admin/shop/product');

    }

    public function destroy($id){
        $item = ShopProductModel::find($id);
        $item->delete();

        return redirect('/admin/shop/product');

    }
}
