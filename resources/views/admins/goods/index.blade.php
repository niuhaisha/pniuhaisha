@extends('layout.admins')

@section('title', '用户的列表页')



@section('content')
<div class="mws-panel grid_8">
    
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i>用户列表页</span>
    </div>

    <div class="mws-panel-body no-padding">
    <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
    <form action="/admin/goods/index" method='get'>
        <div id="DataTables_Table_1_length" class="dataTables_length">
            <label>
                显示
                <select name="num" size="1" aria-controls="DataTables_Table_1">
                    <option value="5" @if($request->num == '5') selected="selected" @endif>
                        5
                    </option>
                    <option value="10" @if($request->num == '10') selected="selected" @endif>
                        10
                    </option>
                   
                </select>
                条数据
            </label>
        </div>
        <div class="dataTables_filter" id="DataTables_Table_1_filter">
            <label>
                关键字:
                <input type="text" name='search' value='{{$request->search}}' aria-controls="DataTables_Table_1">
            </label>
            <button class='btn btn-md btn-info'>搜索</button>
        </div>
    </form>

        <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
        aria-describedby="DataTables_Table_1_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 188px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                        ID
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 243px;" aria-label="Browser: activate to sort column ascending">
                        商品名
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 228px;" aria-label="Platform(s): activate to sort column ascending">
                        价格
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 160px;" aria-label="Engine version: activate to sort column ascending">
                        颜色
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 117px;" aria-label="CSS grade: activate to sort column ascending">
                        尺寸
                    </th>

                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 117px;" aria-label="CSS grade: activate to sort column ascending">
                        内容
                    </th>

                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 117px;" aria-label="CSS grade: activate to sort column ascending">
                        状态
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1" style="width: 150px;" aria-label="CSS grade: activate to sort column ascending">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
            @foreach($res as $k => $v)
                <tr class="@if ($k % 2 == 1) odd @else even @endif">
                    <td class="  sorting_1">
                        {{$v->id}}
                    </td>
                    <td class=" ">
                        {{$v->title}}
                    </td>
                    <td class=" ">
                        {{$v->price}}
                       
                    </td>
                    <td class=" ">
                        {{$v->color}}
                        
                    </td>

                    <td class=" ">
                        {{$v->size}}
                        
                    </td>

                    <td class=" ">
                        {{$v->content}}
                        
                    </td>

                    {{--<td class=" ">
                      
                       <img src="{{$v->profile}}" alt="">
                   </td> --}}

                    <td class=" ">
                       
                        {{$v->status}}
                    </td>
                    <td class=" ">
                       
                        <a href="/admin/goods/edit/{{$v->id}}" class='btn btn-success'>修改</a>
                        <a href="/admin/goods/delete/{{$v->id}}" class='btn btn-warning'>删除</a>

                    </td>
                </tr>
               
            @endforeach 
               
            </tbody>
        </table>

        <style type="text/css">
		#page li{

			background-color: #444444;
    border-left: 1px solid rgba(255, 255, 255, 0.15);
    border-right: 1px solid rgba(0, 0, 0, 0.5);
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.5), 0 1px 0 rgba(255, 255, 255, 0.15) inset;
    color: #fff;
    cursor: pointer;
    display: block;
    float: left;
    font-size: 12px;
    height: 20px;
    line-height: 20px;
    outline: medium none;
    padding: 0 10px;
    text-align: center;
    text-decoration: none;
		}
		#page .active{
		background-color: #88a9eb;
		background-image: none;
    border: medium none;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.25) inset;
    color: #323232;
		}

		#page a{

			 color: #fff;
		}

		#page .disabled{

			 color: #666666;
    		cursor: default;
		}

		#page ul{

			margin:0px;
		}


        </style>
       


        <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">

        	<div id='page'>
            {!! $res->appends($request->all())->render() !!}
            </div>
            
        </div>
    </div>
</div>
</div>

@endsection