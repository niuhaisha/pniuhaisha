@extends('layout.admins')

@section('title', '商品添加页面')

@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>商品添加页面</span>
    </div>
  
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
    	<form action="/admin/goods/insert" method='post' enctype='multipart/form-data' class="mws-form">
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">商品名:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='title' value="{{old('username')}}">
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">价格:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='price'>
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">颜色:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='color'>
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label">尺码:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='size' value="{{old('email')}}">
    				</div>
    			</div>

          <div class="mws-form-row">
            <label class="mws-form-label">分类名:</label>
            <div class="mws-form-item">
              <select class="small" name='cate_id'>
                <option value='0'>请选择</option>
              @foreach($res as $k => $v)

                <option value='{{$v->id}}'>{{$v->name}}</option>

                @endforeach
              </select>
            </div>
          </div>

          <script type="text/javascript" charset="utf-8" src="/admins/ueditor/ueditor.config.js"></script>
          <script type="text/javascript" charset="utf-8" src="/admins/ueditor/ueditor.all.min.js"> </script>
          <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
          <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
          <script type="text/javascript" charset="utf-8" src="/admins/ueditor/lang/zh-cn/zh-cn.js"></script>

    			<div class="mws-form-row">
    				<label class="mws-form-label">详情:</label>
    				<div class="mws-form-item">
    					<script id="editor" name='content' type="text/plain" style="width:800px;height:400px;"></script>
    				</div>
    			</div>


          <script type="text/javascript">

              //实例化编辑器
              //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
              var ue = UE.getEditor('editor');


              
          </script>

    			<div class="mws-form-row">
    				<label class="mws-form-label">图片:</label>
    				<div class="mws-form-item">
    					<input type="file" name='pic[]' multiple readonly="readonly" style="width: 100%; padding-right: 85px;" class="fileinput-preview" placeholder="No file selected...">
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