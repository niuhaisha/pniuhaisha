@extends('layout.admins')

@section('title', '用户添加页面')

@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>用户添加页面</span>
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
    	<form action="/admin/user/insert" method='post' enctype='multipart/form-data' class="mws-form">
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">用户名:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='username' value="{{old('username')}}">
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">密码:</label>
    				<div class="mws-form-item">
    					<input type="password" class="small" name='password'>
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">确认密码:</label>
    				<div class="mws-form-item">
    					<input type="password" class="small" name='repassword'>
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">邮箱:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='email' value="{{old('email')}}">
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">手机号:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='phone' value="{{old('phone')}}">
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">头像:</label>
    				<div class="mws-form-item">
    					<input type="file" name='pic' readonly="readonly" style="width: 100%; padding-right: 85px;" class="fileinput-preview" placeholder="No file selected...">
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

@section('js')
<script type="text/javascript">

	setTimeout(function(){

		$('.mws-form-message').fadeOut(2000);
	},3000)

</script>
@endsection