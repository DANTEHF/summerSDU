<html>
	<head></head>
	<body>
		<div>{{$name}}你好，</div>
		<div>您的app： {{$appname}} 有问题！！！！。</div>
		<div>违反了以下预警规则：</div>
		<div>{{$item}}应@if($alert->trigger === 0)小于@else大于@endif前{{$alert->days}}天的{{$alert->limit}}%</div>
		<div>请登录网站查看 <a href="http://123.206.184.214/login">http://123.206.184.214/login</a> </div>
		<!--div>以下是您的邮箱和密码，请用硬币刮开</div>
		<div>邮箱：</div>
		<div>************************</div>
		<div>************************</div>
		<div>************************</div>
		<div>************************</div>
		<div>************************</div>
		<div>密码：</div>
		<div>************************</div>
		<div>************************</div>
		<div>************************</div>
		<div>************************</div>
		<div>************************</div-->
		
		<div>并不）感谢您的使用</div>
	</body>
</html>