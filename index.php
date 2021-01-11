<?php
session_start(); 

if($_GET['id']=='upload'){
echo '<html><head><meta charset="utf-8"><link rel="icon" href="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=389008376,2050596747&fm=26&gp=0.jpg"><title>上传音频-音乐网盘</title></head><body>
<form action="?id=upload&ids=sc" method="post" enctype="multipart/form-data">
<p>请选择要上传的音频文件:<br><input type="file" name="myFile"></p>
<input type="submit" value="上传">

</form>
<br><a href="?">返回首页</a><br></body></html>';
if($_GET['ids']=='sc'){
$wenjian = $_FILES['myFile']['name'];
$lj = $_FILES['myFile']['tmp_name'];
date_default_timezone_set('Asia/beijing');
$time = date("Y年m月d日-H时i分s秒"); 
@copy($lj, 'music/'.base64_encode("[$time]".$wenjian));
}
}else if($_GET['id']=='music'){
$ml=dirname(__FILE__).'/music'; 
$musics = scandir($ml);
if($_GET['ids']=='bf'){
echo '<html><head><meta charset="utf-8"><link rel="icon" href="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=389008376,2050596747&fm=26&gp=0.jpg"><title>查看文件-音乐网盘</title></head><body>';
echo '
<audio controls="controls">
  <source src="'.'music/'.$_GET['musicid'].'" type="audio/mpeg">
  <source src="'.'music/'.$_GET['musicid'].'" type="audio/ogg">
Your browser does not support the audio element.
</audio>
';
}
foreach ($musics as $music) {

if($music=='.' or $music=='..'){
}else{

echo "<hr>".base64_decode($music)."｜<a href=".'"'."?id=music&ids=bf&musicid=$music".'"'.'>播放</a> <a href='.'"'."?id=delete&delete=$music".'"'.'>删除</a>';
}
}
echo '<br><a href="?">返回首页</a><br>';
}else if($_GET['id']=='admin'){
if($_SESSION['身份认证']=='ture'){
echo '<html><head><meta charset="utf-8"><link rel="icon" href="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=389008376,2050596747&fm=26&gp=0.jpg"><title>您已登陆过</title></head><body><br>登陆状态：已登陆<br></body></html>';
}else{
echo '<html><head><meta charset="utf-8"><link rel="icon" href="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=389008376,2050596747&fm=26&gp=0.jpg"><title>管理员登陆-音乐网盘</title></head><body>
<form name="form" method="post" action="?id=admin&admin=login">
<p>管理员账号：<input type="text" name="username" required placeholder="管理员账号"></p>
<p>管理员密码：<input type="passwordr" name="password" required placeholder="管理员密码"></p>
<input type="submit" value="提交">
</form>';
if($_GET['admin']=='login'){
if( $_POST['username']=='aqi' && $_POST['password']=='aqi'){
$_SESSION['身份认证']='ture';
echo '<br>管理员登陆成功！<br>';
}else{
echo '<br>管理员登陆失败！<br>';
}
}
}
echo '<br><a href="?">返回首页</a><br></body></html>';
}else if($_GET['id']=='delete'){
echo '<html><head><meta charset="utf-8"><link rel="icon" href="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=389008376,2050596747&fm=26&gp=0.jpg"><title>删除-音乐网盘</title></head><body>';
if($_SESSION['身份认证']=='ture'){
unlink('music/'.$_GET['delete']);
echo '<br>删除成功<br>';
}else{
echo '<br>你无权操作<br>';
}
echo '<a href="?">返回首页</a></body></html>';
}else if($_GET['id']=='xy'){
echo '
<html><head><meta charset="utf-8"><link rel="icon" href="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=389008376,2050596747&fm=26&gp=0.jpg"><title>用户协议-音乐网盘</title></head><body>
<h1><center>《用户协议》</center> </h1>
<p><font color="red">重要提示：</font><br>
请您仔细阅读以下条款，并确认您已完全理解本协议之规定，尤其是免除及限制责任的条款、知识产权条款、法律适用及争议解决条款。<br>

若您对本声明或本协议任何条款有异议，请停止注册或使用本网站所提供的全部服务。</p>

<hr>
<h2>欢迎使用php音乐网盘</h2>
<p>您使用该网盘则默认您同意用户协议</p>
<hr><center><p>音乐网盘程序2.0<br>你是七月热情风</p></center>
<body style="background:url(img/01.jpg)"  >
</body></html>
';
}else{
echo '<html><head><meta charset="utf-8"><link rel="icon" href="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=389008376,2050596747&fm=26&gp=0.jpg"><title>音乐网盘-首页</title></head><body>
<center><h1>首页</h1><hr>
<a href="?id=upload"><h1>上传音频</h1></a><br>
<a href="?id=music"><h1>查看音频</h1></a><embed src="C:\music" autostart="true" loop="true" hidden="true"> </embed> <br>

<a href="?id=admin"><h1>管理后台</h1></a><br>
<a href="?id=xy"><h1>用户协议</h1></a><br></center>
<body style="background:url(img/01.jpg)">
</body></html>
';
}
?>