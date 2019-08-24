<?php

namespace App\Providers;

use App\Model\Admin\MenuItemModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $menus_items_header=MenuItemModel::getMenuItemsByHeader();
        $menus_items_header_html=MenuItemModel::getMenuUlLi($menus_items_header);
        $menus_items_footer1=MenuItemModel::getMenuItemsByFooter1();
        $menus_items_footer2=MenuItemModel::getMenuItemsByFooter2();
        $menus_items_footer3=MenuItemModel::getMenuItemsByFooter3();



        View::share('fe_menus_items_header', $menus_items_header);
        View::share('fe_menus_items_header_html', $menus_items_header_html);
        View::share('fe_menus_items_footer1', $menus_items_footer1);
        View::share('fe_menus_items_footer2', $menus_items_footer2);
        View::share('fe_menus_items_footer3', $menus_items_footer3);
    }
}
