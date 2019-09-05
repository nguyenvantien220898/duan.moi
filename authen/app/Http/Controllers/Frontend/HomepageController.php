<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Front\BannerModel;
use App\Model\Front\BrandModel;
use App\Model\Front\ShopCategoryModel;
use App\Model\Front\ShopProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    //
    public function index() {
        $data = array();
        $data['banner_main'] = BannerModel::getBannerByLocation(1);
        $data['banner_sale_1'] = BannerModel::getBannerByLocation(2);
        $data['banner_sale_2'] = BannerModel::getBannerByLocation(3);
        $data['banner_sale_3'] = BannerModel::getBannerByLocation(4);
        $data['banner_sale_4'] = BannerModel::getBannerByLocation(5);
        $data['banner_sale_5'] = BannerModel::getBannerByLocation(6);
        $data['brands'] = BrandModel::all();
        $homepage_category = ShopCategoryModel::where('homepage',1)->orderBy('id','asc')->take(4)->get();
        foreach ($homepage_category as $key => $category){
            $homepage_category[$key]['products'] = ShopProductModel::where(['cat_id' => $category->id, 'homepage' => 1])->take(8)->orderBy('id','asc')->get();
        }
        $data['homepage_category'] = $homepage_category;

        return view('frontend.homepages.index',$data);
    }
}
