<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>元器件管理系统</title>
<style>
* {
  box-sizing: border-box;
}
 
body {
  font-family: Arial;
  background: #f1f1f1;
}
 
 
/* 创建两列 */
/* Left column */
.leftcolumn {
  /*border-right: solid;   */
  float: left;
  width: 15%;
  height: 100%;
}
 
/* 右侧栏 */
.rightcolumn {
  float: left;
  width: 85%;
  height: 800px;
  background-color: #f1f1f1;
  /*border-left: solid;*/
  /*padding-left: 10px;*/
}
 
/* 图像部分 */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}
 
/* 文章卡片效果 */
.card {
  background-color: white;
  padding-left: 20px;
  /*margin-top: 20px;*/
  height: 100%;
}

.treeLog ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 100%;
    /*background-color: #f1f1f1;*/
}

.treeLog li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

li a:hover{
    background-color: #555;
    color: white;
    cursor:pointer 
}

iframe {
	width: 100%;
	height: 100%;
  display: block;

}
 
/* 列后面清除浮动 */

.row:after {
  content: "";
  display: table;
  clear: both;
}
 

 
/* 响应式布局 - 屏幕尺寸小于 800px 时，两列布局改为上下布局 */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    height: 80%;
    padding: 0;
  }
}
 
</style>
<link rel="stylesheet" type="text/css" href="/Public/other/bootstrap-3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/css/datatables.min.css">
<script src="/Public/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="/Public/other/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="/Public/js/datatables.min.js"></script>
<script>
	$(document).ready(function(){  
		$("#compManage").click(function(){
			$('iframe').attr('src',"<?php echo U('Home/Manage/compManage');?>");
		});
		$("#compOut").click(function(){
			$('iframe').attr('src',"<?php echo U('Home/Manage/compOut');?>");
		});
		$("#compIn").click(function(){
			$('iframe').attr('src',"<?php echo U('Home/Manage/compIn');?>");
		});
		$("#dicManage").click(function(){
			$('iframe').attr('src',"<?php echo U('Home/Manage/dicManage');?>");
		});
    $("#logManage").click(function(){
      $('iframe').attr('src',"<?php echo U('Home/Manage/index');?>");
    });
    $("#userManage").click(function(){
      $('iframe').attr('src',"<?php echo U('Home/Manage/userManage');?>");
    });
	});
</script>
</head>
<body>

<!-- <div class="header">
  <h1>我的网页</h1>
</div> -->


<div class="row">
  <div class="leftcolumn">
    <div class="treeLog card">
	    <ul>
		  <li id="compManage"><a><span class="glyphicon glyphicon-lock">  元器件库</a></li> 
		  <li id="compIn"><a><span class="glyphicon glyphicon-import"> 入库管理</a></li> 
      <li id="compOut"><a><span class="glyphicon glyphicon-export">  出库管理</a></li>
		  <li id="dicManage"><a><span class="glyphicon glyphicon-th-list"> 字典管理</a></li><li id="userManage"><a><span class="glyphicon glyphicon-user"> 用户管理</a></li>
      <li id="logManage"><a><span class="glyphicon glyphicon-lock"> 操作日志</a></li>
		</ul>
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      <iframe frameBorder="0" src="<?php echo U('Home/Manage/index');?>"></iframe>
    </div>
  </div>
</div>

</body>
</html>