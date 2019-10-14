<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('userRegiter','Member@userRegiter');//定义用户注册接口路由
Route::post('userLogin','Member@userLogin');//定义用户登录接口路由
Route::post('userBasics','Member@userBasics');//定义用户基本信息接口路由
Route::get('userInfo','Member@userInfo');//定义用户完整信息接口路由
Route::post('imgUpdate','Member@imgUpdate');//定义修改图像路由