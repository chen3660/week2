<?php

namespace App\Http\Controllers;

use App\Members;
use Illuminate\Http\Request;
use Validator;

class Member extends Controller
{
    public function userRegiter(Request $request)//用户注册接口
    {//用户注册方法
        //return 1;
        $validator = Validator::make($request->all(), [//Validator验证器
            'member_phone' => 'required|unique:member',
            'name' => 'required',
            'nickname' => 'required',
            'pwd' => 'required',
            'qpwd' => 'required',
        ]);

        if ($validator->fails()) {//返回错误信息
            $msg = $validator->errors()->first();
            return ['code' => 1, 'msg' => $msg, 'data' => ''];
        }

        if ($request['pwd'] != $request['qpwd']) {//判断密码是否一致
            return ['code' => 1, 'msg' => '密码不一致', 'data' => ''];
        }

        if (strlen($request['member_phone']) != 11) {
            return ['code' => 1, 'msg' => '手机号不符合格式', 'data' => ''];
        }
        $pwds = md5($request['pwd']);//密码mad5加密

        $model = new Members();
        $model->member_name = $request['name'];
        $model->member_phone = $request['member_phone'];
        $model->member_pwd = $pwds;
        $model->member_nickname = $request['nickname'];
        if ($model->save()) {//数据添加 判断  返回接口三要素
            return ['code' => 0, 'msg' => '注册成功', 'data' => ''];
        } else {
            return ['code' => 1, 'msg' => '注册失败', 'data' => ''];
        }

    }

    public function userLogin(Request $request)//用户登录接口 完成登录
    {
        $validator = Validator::make($request->all(), [//Validator验证器
            'member_phone' => 'required|max:11',
            'pwd' => 'required',
        ]);

        if ($validator->fails()) {//返回错误信息
            $msg = $validator->errors()->first();
            return ['code' => 1, 'msg' => $msg, 'data' => ''];
        }

        if (strlen($request['member_phone']) != 11) {//判断手机号格式是否正确
            return ['code' => 1, 'msg' => '手机号不符合格式', 'data' => ''];
        }
        $pwds = md5($request['pwd']);//密码md5解码

        $model = new Members();
        $count = $model->where('member_phone', $request['member_phone'])->where('member_pwd', $pwds)->count();
        if ($count > 0){
            $userinfo = $model->where('member_phone', $request['member_phone'])->where('member_pwd', $pwds)->first();
            $id = $userinfo['member_id'];
            session(['id' => $id]);//将用户ID存进Session；
            return ['code' => 0, 'msg' => '登录成功', 'data' => ''];
        }else{
            return ['code' => 1, 'msg' => '登录失败', 'data' => ''];
        }
    }

    public function userBasics(Request $request){//用户基本信息接口
        $validator = Validator::make($request->all(), [//Validator验证器
            'nickname' => 'required',
            'QQ' => 'required|Integer',
            'career' => 'required',
        ]);

        if ($validator->fails()) {//返回错误信息
            $msg = $validator->errors()->first();
            return ['code' => 1, 'msg' => $msg, 'data' => ''];
        }
        $career = $request['career'];
        $nickname = $request['nickname'];
        $qq = $request['QQ'];

        $id = $request->session()->get('id');

        $model = new Members();
        $res = $model -> where('member_id',$id) -> update(['member_career'=>$career,'member_nickname'=>$nickname,'member_QQ'=>$qq]);//修改用户基本信息

        if ($res) {//返回接口三要素
            return ['code' => 0, 'msg' => '基本信息绑定成功', 'data' => ''];
        } else {
            return ['code' => 1, 'msg' => '基本信息绑定失败', 'data' => ''];
        }
    }

    public function userInfo(Request $request){//用户个人信息接口
        $id = $request->session()->get('id');
        $model = new Members();
        $data = $model -> where('member_id',$id)->first();
        return ['code' => 0, 'msg' => '成功', 'data' => $data];//返回用户个人信息以接口形式
    }

    public function imgUpdate(Request $request){//文件上传
        $id = $request['id'];//接受隐藏域的用户ID

        $path = $request->file('img')->store('uploads');

        $img = "http://localhost/nine/secondweek/public/".$path;
        $model = new Members();
        $res = $model -> where('member_id',$id)->update(['member_img'=>$img]);//修改图片路径
        if ($res) {//返回接口
            return ['code' => 0, 'msg' => '图片上传成功', 'data' => ''];
        } else {
            return ['code' => 1, 'msg' => '图片上传失败', 'data' => ''];
        }
    }


}
