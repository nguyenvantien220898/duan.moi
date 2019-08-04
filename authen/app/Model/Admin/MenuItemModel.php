<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class MenuItemModel extends Model
{
    //
    public $table='menu_items';


    public static function getTypeOfMenuItem(){

        $type=array();
        $type[1]='Shop category';
        $type[2]='Shop product';
        $type[3]='Content category';
        $type[4]='Content post';
        $type[5]='Content page';
        $type[6]='Content tag';
        $type[7]='Custom link';

        return $type;
    }

}
