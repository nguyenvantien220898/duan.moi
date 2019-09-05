<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ShopOrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopOrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index() {
        $items = DB::table('orders')->paginate(10);
        $data = array();
        $data['orders'] = $items ;
        $data['total'] = $items->total();
        return view('admin.content.shop.order.index',$data) ;
    }
    public function edit($id){
        $item = ShopOrderModel::find($id);
        $data = array();
        $data['order'] = $item;
        return view('admin.content.shop.order.edit',$data) ;
    }
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'customer_address' => 'required',
            'customer_city' => 'required',
            'customer_country' => 'required',
            'total_price' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $order = ShopOrderModel::find($id);
        $order->customer_name = $input['customer_name'];
        $order->customer_phone = $input['customer_phone'];
        $order->customer_email = $input['customer_email'];
        $order->customer_note = isset($input['customer_note']) ? $input['customer_note'] : '';
        $order->customer_address = $input['customer_address'];
        $order->customer_city = $input['customer_city'];
        $order->customer_country = $input['customer_country'];
        $order->total_price = (int)$input['total_price'];
        $order->status = $input['status'];
        $order->save();
        return redirect('/admin/shop/order');
    }
    public function delete($id) {
        $item = ShopOrderModel::find($id);
        $data = array();
        $data['order'] = $item;
        return view('admin.content.shop.order.delete',$data) ;
    }
    public function destroy($id) {
        $item = ShopOrderModel::find($id);
        $item->delete();
        return redirect('/admin/shop/order');
    }
}
