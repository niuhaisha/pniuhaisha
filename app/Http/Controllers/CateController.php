<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CateController extends Controller
{
    /**
    *	分类的添加方法
    */
    public function getAdd()
    {
    	//select *,concat(path,',',id) as paths from cates order by paths;
    	$res = self::getCateType();

    	return view('admins.cate.add',['res'=>$res]);
    }

    /**
    *	添加分类处理数据的方法
    */
    public function postInsert(Request $request)
    {

    	//表单验证


    	// var_dump($_POST);
    	$res = $request->except('_token');

    	// var_dump($res);

    	if ($res['pid'] == '0') {

    		//凭借path
    		$res['path'] = '0';
    	} else {

    		$info = DB::table('cates')->where('id', $res['pid'])->first();

    		// var_dump($info);
    		$res['path'] = $info->path.','.$info->id;
    	}


    	$data = DB::table('cates')->insert($res);

    	if ($data) {

    		return redirect('/admin/cate/index');
    	} else {

    		return back();
    	}
    }

    public function getIndex(Request $request)
    {

    	// $data = $request->all();

    	//var_dump($data);


    	$res = DB::table('cates')->
    	select(DB::raw("*,concat(path,',',id) as paths"))->
    	orderBy('paths')->
    	where('name','like','%'.$request->input('search').'%')->
    	paginate($request->input('num',5));

    	foreach($res as $k => $v){

    		//拆分path
    		$data = explode(',',$v->path);

    		$count = count($data)-1;

    		$v->name = str_repeat('|--', $count).$v->name;
    	}

    	return view('admins.cate.index',['res'=>$res,'request'=>$request]);
    }


    public function getEdit($id)
    {

    	$res = self::getCateType();


    	$data = DB::table('cates')->where('id', $id)->first();

    	return view('admins.cate.edit',['data'=>$data, 'res'=>$res]);
    }

    public function postUpdate(Request $request)
    {	
    	$res = $request->except('_token','id');

    	$id = $request->input('id');

    	$data = DB::table('cates')->where('id', $id)->update($res);

    	if ($data) {

    		return redirect('/admin/cate/index');
    	} else {

    		return back();
    	}
    }

    public static function getCateType()
    {
        $res = DB::table('cates')->
        select(DB::raw("*,concat(path,',',id) as paths"))->
        orderBy('paths')->
        get();

        //通过path判断
        foreach($res as $k => $v){

            //拆分path
            $data = explode(',',$v->path);

            $count = count($data)-1;

            $v->name = str_repeat('|--', $count).$v->name;
        } 

        return $res;

    }


    public function getDelete(Request $request)
    {
    	$id = $request->input('id');
    	// $id = $_GET['id'];

    	// echo $id;
    	//根据id查询有没有子类
    	$res = DB::table('cates')->where('id', $id)->first();

    	$path = $res->path.','.$res->id;   //0,1,5

    	//echo $path;



    	//var_dump($res);

    	//path 0,2,12         0,2,12   ,13   ,14    path  like $path,%

    	//如果有 先删除子类  然后再删除本身
                                              //0,1,5,14
    	DB::table('cates')->where('path', 'like', $path.'%')->delete();

    	$row = DB::table('cates')->where('id', $id)->delete();



    	//如果没有子类  直接删除

    	if ($res) {

    		return redirect('/admin/cate/index');
    	} else {

    		return back();
    	}
    }


  /*  [
    	id=>1
    	name => 男装
    	pid=>1
    	status=>1
    	sub_cate =>[
    		[
    		id=>1
	    	name => 西裤
	    	pid=>1
	    	status=>1
	    	sub_cate =>[
	    			[id=>1
			    	name => 法式西裤
			    	pid=>1
			    	status=>1
			    	],
	    			[id=>1
			    	name => 中式西裤
			    	pid=>1
			    	status=>1
			    	]
	    		]
	    	],
    		[
    		id=>1
	    	name => 西服
	    	pid=>1
	    	status=>1
	    	],
    		[
    		id=>1
	    	name => 大衣
	    	pid=>1
	    	status=>1
	    	]


    	]

    	id=>1
    	name => 女装
    	pid=>1
    	status=>1


    	id=>1
    	name => 童装
    	pid=>1
    	status=>1


    ]*/

    //
    public static function getCateDiGuiMessage($pid)
    {
    	$megs = DB::table('cates')->where('pid', $pid)->get();

    	$sub_arr = [];
    	foreach($megs as $k => $v){

    		$v->sub_cate = self::getCateDiGuiMessage($v->id);

    		$sub_arr[] = $v;	
    	}

    	return $sub_arr;
    }


    public function getCate()
    {
    	$res = $this->getCateDiGuiMessage(0);
    	// echo '<pre>';
    	 // var_dump($res);
    	// dd($res);
    	//$v->sub_cate = $this->

    	return view('admins.cate.test',['res'=>$res]);
    }


}
