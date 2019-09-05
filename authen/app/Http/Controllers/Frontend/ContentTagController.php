<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Front\ContentTagModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\ContentPostModel;

class ContentTagController extends Controller
{
    //
    public function detail($id){
        $item = ContentTagModel::find($id);
        $data = array();
        $data['tag'] = $item;
        $data['posts'] = ContentPostModel::where('cat_id',$id)->paginate(10);
        return  view('frontend.content.tag.detail',$data);
    }
}
