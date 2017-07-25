<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
		<ul>
		@foreach($res as $k=>$v)
			<li>
			{{$v->name}}
				<ul>
				@foreach($v->sub_cate as $kk => $vv)
					<li>
					{{$vv->name}}
						<ul>
							@foreach($vv->sub_cate as $ks => $vs)
							<li>{{$vs->name}}</li>
							@endforeach
						</ul>
					</li>
				@endforeach
				</ul>
			</li>
		@endforeach
		</ul>

</body>
</html>