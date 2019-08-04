<?php

namespace App\Http\Controllers;

use App\Model\ShipperModel;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    //
    /**
     * hàm khởi tạo của class được chạy ngay khi khởi tạo đối tượng
     * hàm này nó luôn đươc chạy trước các hàm khác trong class
     * SellerController constructor.
     */
    public  function __construct()
    {
        $this->middleware('auth:shipper')->only('index');
    }
    /**phương thức trả về view khi đăng nhập seller thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(){
        return view('shipper.dashboard');
    }
    public function create(){
        return view('shipper.auth.register');
    }
    public function store(Request $request){
        $this->validate($request,array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ));

        //khởi tạo model để lưu admin mới
        $shipperModel=new ShipperModel();
        $shipperModel->name = $request->name;
        $shipperModel->email = $request->email;
        $shipperModel->password = bcrypt($request->password);
        $shipperModel->save();

        return redirect()->route('shipper.auth.login');

    }
}

