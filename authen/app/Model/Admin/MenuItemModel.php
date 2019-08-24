<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class MenuItemModel extends Model
{
    //
    public $table='menu_items';


    public static function OutputLevelCategories($input_categories,&$output_categories,$parent_id = 0, $lv1 = 1){

        if (count($input_categories) > 0) {
            foreach ($input_categories as $key=>$category){
                $category=(array) $category;

                if ($category['parent_id'] == $parent_id){
                    $category['level'] = $lv1;
                    $output_categories[] = (array) $category;
                    unset($input_categories[$key]);

                    $new_parent_id = $category['id'];
                    $new_level = $lv1 + 1;
                    self::OutputLevelCategories($input_categories,$output_category,$new_parent_id,$new_level);
                }
            }
        }
    }


    public static function OutputLevelCategoriesExcept($input_categories,&$output_categories,$parent_id = 0, $lv1 = 1,$except){

        if (count($input_categories) > 0) {
            foreach ($input_categories as $key=>$category){

                if ($category['parent_id'] == $parent_id){
                    $category['level'] = $lv1;
                    if ($category['id']!=$except){
                        $output_categories[]=(array)$category;
                    }
                    unset($input_categories[$key]);

                    if ($category['id']!=$except){
                        $new_parent_id = $category['id'];
                        $new_level = $lv1 + 1;
                        self::OutputLevelCategories($input_categories,$output_category,$new_parent_id,$new_level,$except);
                    }

                }
            }
        }
    }

    public static function getMenuItemRecursiveExcept($except){
        $result=array();
        $source=MenuItemModel::all()->toArray();


        self::OutputLevelCategoriesExcept($source,$result,0,1,$except);


        return $result;


    }

    public static function getMenuItemRecursive(){
        $result=array();
        $source=MenuItemModel::all()->toArray();


        self::OutputLevelCategories($source,$result);


        return $result;


    }


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

    public static function getMenuItemsByHeader(){
        $menu_header = DB::table('menus')->where('location', 1)->first();
        if (isset($menu_header->id)){
            $source = DB::table('menu_items')->where('menu_id', $menu_header->id)->orderBy('sort','ASC')->get()->toArray();


            $result=array();


            self::OutputLevelCategories($source,$result);

        }else{
            $result=array();
        }
        return $result;

    }

    public static function getMenuItemsByFooter1(){
        $menu_header = DB::table('menus')->where('location', 2)->first();
        if (isset($menu_header->id)){
            $menu_items_header = DB::table('menu_items')->where('menu_id', $menu_header->id)->get();

        }else{
            $menu_items_header=array();
        }

        return $menu_items_header;

    }
    public static function getMenuItemsByFooter2(){
        $menu_header = DB::table('menus')->where('location', 3)->first();
        if (isset($menu_header->id)){

        }else{
            $menu_header=array();
        }
        $menu_items_header = DB::table('menu_items')->where('menu_id', $menu_header->id)->get();

        return $menu_items_header;



    }
    public static function getMenuItemsByFooter3(){
        $menu_header = DB::table('menus')->where('location', 4)->first();
        if (isset($menu_header->id)){
            $menu_items_header = DB::table('menu_items')->where('menu_id', $menu_header->id)->get();

        }else{
            $menu_items_header=array();
        }
        return $menu_items_header;



    }

    public static function BuildMenuHTML($input_categories,&$html,$parent_id = 0, $lv1 = 1){
        if (count($input_categories) > 0) {
            if($lv1 == 1){
                $html .= "<ul class='nav navbar-nav '>";
            }else if($lv1 == 2){
                $html .= "<ul class=\"dropdown-menu multi\">
                                <div class=\"row\">
                                    <div class=\"col-sm-4\">
                                        <ul class=\"multi-column-dropdown\">";
            }else{
                // Chỉ hiện thị 2 cấp nên từ cấp thứ 3 sẽ không hiển thị nữa
            }
            foreach ($input_categories as $category){
                if ($category['parent_id'] == $parent_id){
                    $category['level'] = $lv1;
                    if ($category['type'] == 7){
                        $menu_link = $category['link'];
                    }else {
                        $menu_link = url($category['link']);
                    }
                    if($lv1 == 1){
                        $li_class = (isset($category['total']) && $category['total'] > 0) ? 'dropdown' : '';
                        $li_icon = (isset($category['total']) && $category['total'] > 0) ? '<b class="caret"></b>' : '';
                        $html .= "<li class='".$li_class."'><a href='".$menu_link."' target='_blank' class=\"hyper\"><span>";
                        $html .= $category['name'].$li_icon;
                    } elseif ($lv1 == 2){
                        $html .= "<li><a href='".$menu_link."' target='_blank'><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>";
                        $html .= $category['name'];
                    }else{
                    }
                    $new_parent_id = $category['id'];
                    $new_level = $lv1 + 1;
                    self::BuildMenuHTML($input_categories,$html,$new_parent_id,$new_level);
                    if($lv1 == 1){
                        $html .= "</span></a></li>";
                    } elseif ($lv1 == 2){
                        $html .= "</a></li>";
                    }else{
                    }
                }
            }
            if($lv1 == 1){
                $html .= "</ul>";
            }else if($lv1 == 2){
                $html .= "</ul>
                    </div>
                    <div class=\"clearfix\"></div>
                </div>
            </ul>";
            }else{
                // Chỉ hiện thị 2 cấp nên từ cấp thứ 3 sẽ không hiển thị nữa
            }
        }
    }
    public static function getMenuUlLi($source) {
        $html_menu = '';
        self::BuildMenuHTML($source,$html_menu);
        return $html_menu;
    }

}
