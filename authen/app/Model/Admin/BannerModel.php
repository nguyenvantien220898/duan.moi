<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    //
    public $table='banners';


    public static function getBannerLocation(){

        $location=array();
        $location[1]='Main banner';
        $location[2]='Sale 1';
        $location[3]='Sale 2';
        $location[4]='Sale 3';
        $location[5]='Sale 4';
        $location[6]='Sale 5';

        return $location;


    }
}
