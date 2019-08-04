<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ConfigModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ConfigController extends Controller
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
        $items = ConfigModel::all();

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data=array();
        $data['configs']=$items;

        return view('admin.content.config.index',$data);

    }

    public function store(){

    }
}
