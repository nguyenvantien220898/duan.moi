<?php
namespace App\Http\Controllers\Frontend;
use App\Model\Front\ShopProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ShopCartController extends Controller
{
    //View Giỏ hàng
    public function index() {
        $data = array();
        $cartCollection = \Cart::getContent();
        $total = \Cart::getTotal();
        $data['cart_products'] = $cartCollection;
        $data['total_payment'] = $total;
        return view ('frontend.cart.index',$data);
    }
    // Add to cart
    public function add(Request $request) {
        $input = $request->all();
        $product_id = (int)$input['w3ls1_item'];
        $quatity = (int)$input['add'];
        $product = ShopProductModel::find($product_id);
        $response['status'] = 0;
        if ($product->id) {
            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->priceSale,
                'quantity' => $quatity,
                'attributes' => array(
                    'image' => $product->images,
                )
            ));
            $response['status'] = 1;
            session()->save();
        }
        echo json_encode($response);
        exit;
    }
    // Update to cart
    public function update(Request $request) {
        $input = $request->all();
        $product_id = (int)$input['product_id'];
        $quatity = (int)$input['quantity'];
        $product = ShopProductModel::find($product_id);
        $response['status'] = 0;
        if ($product->id) {
            \Cart::update($product->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quatity
                ),
            ));
            $response['status'] = 1;
            session()->save();
        }
        echo json_encode($response);
        exit;
    }
    // Remove giỏ hàng
    public function remove(Request $request){
        $input = $request->all();
        $product_id = (int)$input['product_id'];
        $product = ShopProductModel::find($product_id);
        $response['status'] = 0;
        if ($product->id) {
            \Cart::remove($product->id);
            $response['status'] = 1;
            session()->save();
        }
        echo json_encode($response);
        exit;
    }
    // Clear toàn bộ giỏ hàng
    public function clear() {
        \Cart::clear();
    }
}