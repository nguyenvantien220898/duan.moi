<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Front\ContentCategoryModel;
use App\Model\Front\ContentPostModel;
use App\Model\Front\ShopcategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentCategoryController extends Controller
{
    //


    public function detail($id){
        $item=ContentCategoryModel::find($id);
        $data = array();
        $data['category'] = $item;
        $data['posts'] = ContentPostModel::where('cat_id',$id)->paginate(10);


        return  view('frontend.content.category.detail',$data);
    }
}
