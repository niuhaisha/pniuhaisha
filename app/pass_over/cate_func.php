<?php 

	function getCateValue($pid)
	{
		if ($pid == '0'){

			return '顶级分类';
		} else {

			$res = DB::table('cates')->where('id', $pid)->first();

			return $res->name;
		}
	}

	function getStatus($status)
	{
		if ($status == '1') {

			return '启用';
		} else {

			return '禁用';
		}
	}


 