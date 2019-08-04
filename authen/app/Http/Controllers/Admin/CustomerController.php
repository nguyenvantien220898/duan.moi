<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
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
        $items = DB::table('users')->paginate(5);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();
        $data['customers']=$items;

        return view('admin.content.shop.customer.index',$data);

    }

    public function create(){
        /**
         * đây là biến truyền từ controller xuống view
         */
        $data = array();

        return view('admin.content.shop.customer.submit',$data);
    }
}
