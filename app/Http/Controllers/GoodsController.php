<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class GoodsController extends Controller
{
    /**
    *
    *	这是商品添加页面
    */
    public function getAdd()
    {
    	$res = CateController::getCateType();

    	return view('admins.goods.add', ['res'=>$res]);
    

    }
    /**
    *
    *	处理表单穿过来的数据
    */
    public function postInsert(Request $request)
    {
    	// echo '<pre>';
    	// var_dump($_POST);
    	//表单验证

    	//
    	$res = $request->except('_token','pic');

    	$id = DB::table('goods')->orderBy('id')->insertGetId($res);

    	if (!$id) {

    		die('没有找到最后插入的id');
    	}

    	$imgs = $request->hasFile('pic');

    	if ($imgs) {

    		$info = [];
    		//遍历上传的图片
    		foreach ($request->file('pic') as $k => $v){
    			//修改名字
    			$name = rand(11111,99999).time();

    			//获取后缀
    			$suffix = $v->getClientOriginalExtension();

    			//拼接图片路径
    			$v->move('./uploads', $name.'.'.$suffix);

    			$tmp_img['gid'] = $id;

    			$tmp_img['goods_imgs'] = '/uploads/'.$name.'.'.$suffix;

    			$info[] = $tmp_img;
    		}
    	}


    	$data = DB::table('gimgs')->insert($info);

    	if ($data) {

    		return redirect('/admin/goods/index')->with('success','添加成功');
    	} else {

    		return back()->with('success', '添加失败');
    	}

    }

    public function getIndex(Request $request)
    {
    	$res = DB::table('goods')->
    	where('title', 'like', '%'.$request->input('search').'%')->
    	paginate($request->input('num',3));

    	return view('admins.goods.index', ['res'=>$res,'request'=>$request]);
    }

    public function getEdit($id)
    {
    	//表单验证


    	$res = DB::table('goods')->where('id',$id)->first();

    	$gimgs = DB::table('gimgs')->where('gid', $id)->get();

    	$cate = CateController::getCateType();

    	return view('admins.goods.edit',['res'=>$res, 'gimgs'=>$gimgs,'cate'=>$cate]);


    }

    public function getAjaxUpdate(Request $request)
    {
    	$id = $request->input('id');

    	$src = $request->input('src');

    	$res = @unlink('.'.$src);

    	if ($res) {

    		$data = DB::table('gimgs')->where('id', $id)->delete();

    		if($data) {

    			echo 1;die;
    		} else{

    			echo 0;die;
    		}
    	}

    }


    public function postUpdate()
    {

    }

    public function getDelete($id)
    {

        //删除目录里面的图片信息
    
    	//删除gimgs表中的信息

    	//删除goods表中的信息

    	

    }



}
