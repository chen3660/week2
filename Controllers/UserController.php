<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use Psr\Container\ContainerInterface;
class UserController extends Controller
{
    public function  index(){
           echo  Cache::add('aa1','aaa',45);
//        $service = $container->get('Help/Pro');
//        $service->index();
//
//        $a = App::make('Help/Pro');
//        $a->index();
//
//
//        $pro = resolve('Help/Pro');
//        $pro->index();
    }
}