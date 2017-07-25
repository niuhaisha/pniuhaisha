@extends('layout.admins')

@section('title', '分类的添加页面')

@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>分类添加页面</span>
    </div>
   <!--  @if (count($errors) > 0)
   	    <div class="alert alert-danger">
   	        <ul>
   	            @foreach ($errors->all() as $error)
   	                <li style='list-style:none;font-size:17px'>{{ $error }}</li>
   	            @endforeach
   	        </ul>
   	    </div>
   	@endif
   
   
   	<div class="mws-form-message error">
   	This is an error message
       <ul>
       	<li>You are too fast</li>
           <li>You are too slow</li>
       </ul>
   </div> -->

   @if (count($errors) > 0)
   	    <div class="mws-form-message error">
   	        <ul>
   	            @foreach ($errors->all() as $error)
   	                <li style='list-style:none;font-size:17px'>{{ $error }}</li>
   	            @endforeach
   	        </ul>
   	    </div>
   	@endif

    <div class="mws-panel-body no-padding">
    	<form action="/admin/cate/insert" method='post' class="mws-form">

    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">父类名:</label>
    				<div class="mws-form-item">
    					<select class="small" name='pid'>
    						<option value='0'>请选择</option>
							@foreach($res as $k => $v)

    						<option value='{{$v->id}}'>{{$v->name}}</option>

    						@endforeach
    					</select>
    				</div>
    			</div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">分类名:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='name' value="{{old('name')}}">
    				</div>
    			</div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">状态:</label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
    						<li><label><input type="radio" name='status' value='1'>启用</label></li>
    						<li><label><input type="radio" name='status' value='0'>禁用</label></li>
    						
    					</ul>
    				</div>
    			</div>
    		</div>
    		<div class="mws-button-row">
    			<input type="submit" class="btn btn-danger" value="添加">
    			{{csrf_field()}}
    		</div>
    	</form>
    </div>    	
</div>


@endsection