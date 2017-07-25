<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class UserController extends Controller
{
    /**
    *	这是用户的列表页
    */
    public function getIndex(Request $request)
    {
    	//获取数据
    	$res = DB::table('user')->
    	where('username','like','%'.$request->input('search').'%')->
    	paginate(5);

    	return view('admins.user.index',['res'=>$res]);

    }

    /**
    *	这是用户的添加页面
    */	
    public function getAdd()
    {
    	return view('admins.user.add');
    }

    /**
    *	用户处理数据方法
    */
    public function postInsert(Request $request)
    {
    	$this->validate($request, [
	        'username' => 'required|regex:/^\w{6,12}$/|unique:user',
	        'password' => 'required|regex:/^\w{6,10}$/',
	        'repassword'=>'same:password',
	        'email'=>'required|email',
	        'phone'=>'required|regex:/^1[34578]\d{9}$/'

	       
	    ],[

	    	'username.required'=>'用户名不能为空',
	    	'username.unique'=>'用户名已经存在',
	    	'username.regex'=>'用户名格式不正确',
	    	'password.required'=>'密码不能为空',
	    	'password.regex'=>'密码格式不正确',
	    	'repassword.same'=>'两次密码不一致',
	    	'email.required'=>'邮箱不能为空',
	    	'email.email'=>'邮箱格式不正确',
	    	'phone.required'=>'手机号不能为空',
	    	'phone.regex'=>'手机号码格式不正确'
	    ]);

	    $res = $request->except(['repassword','_token','pic']);

	    //上传头像
	    $imgs = $request->hasFile('pic');

	    if ($imgs) {

	    	//上传文件的名字
	    	$name = rand(1111,9999).time();
	    	//获取后缀  $_FILES['pic']
	    	$suffix = $request->file('pic')->getClientOriginalExtension();
	    	//
	    	$request->file('pic')->move('./uploads', $name.'.'.$suffix);
	    }

	    //存入到数据库
	    $res['profile'] = '/uploads/'.$name.'.'.$suffix;

	  	$res['password'] = Hash::make($request->input('password'));


	    $data = DB::table('user')->insert($res);

	    if ($data) {

	    	return redirect('/admin/user/index');
	    } else {

	    	return back();
	    }
    }
}
