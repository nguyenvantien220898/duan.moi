<?php
namespace App\Http\Controllers\Admin;
use App\Model\Admin\ShopBrandModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ShopBrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth:admin");
    }
    public function index() {
        $items = DB::table('shop_brands')->paginate(10);
        $data = array();
        $data['brands'] = $items ;
        $data['total'] = $items->total();
        return view('admin.content.shop.brand.index',$data) ;
    }
    public function create() {
        $data = array();
        return view('admin.content.shop.brand.submit',$data);
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required',
            'link' => 'required',
        ]);
        $input = $request->all();
        $item = new ShopBrandModel();
        $item->name = $input['name'];
        $item->image = $input['image'];
        $item->link = $input['link'];
        $item->intro = isset($input['intro']) ? $input['intro'] : '';
        $item->desc = isset($input['desc']) ? $input['desc'] : '';
        $item->save();
        return redirect('/admin/shop/brand');
    }
    public function edit($id) {
        $item = ShopBrandModel::find($id);
        $data = array();
        $data['brand'] = $item;
        return view ('admin.content.shop.brand.edit',$data);
    }
    public function update(Request $request,$id) {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required',
            'link' => 'required',
        ]);
        $input = $request->all();
        $item = ShopBrandModel::find($id);
        $item->name = $input['name'];
        $item->image = $input['image'];
        $item->link = $input['link'];
        $item->intro = isset($input['intro']) ? $input['intro'] : '';
        $item->desc = isset($input['desc']) ? $input['desc'] : '';
        $item->save();
        return redirect('/admin/shop/brand');
    }
    public function delete($id) {
        $item = ShopBrandModel::find($id);
        $data = array();
        $data['brand'] = $item;
        return view ('admin.content.shop.brand.delete',$data);
    }
    public function destroy($id) {
        $item = ShopBrandModel::find($id);
        $item->delete();
        return redirect('/admin/shop/brand');
    }
}