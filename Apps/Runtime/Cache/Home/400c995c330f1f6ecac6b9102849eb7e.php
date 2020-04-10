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
  /*padding: 10px;*/
  background: #f1f1f1;
}
 

/* 导航条 */
.topnav {
  overflow: hidden;
  background-color: #4682B4;
}
 
/* 导航条链接 */
.topnav h2 {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  margin-left: 20px;
  /*padding: 14px 16px;*/
  text-decoration: none;
}
 
/* 链接颜色修改 */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}
 
 

iframe {
	width: 100%;
	height: 800px;
}
 
/* 列后面清除浮动 */
.row:after {
  content: "";
  display: table;
  clear: both;
}
 
/* 底部 */
.footer {
  padding: 20px;
  text-align: center;
  /*background: #ddd;*/
  margin-top: 20px;
}
 
/* 响应式布局 - 屏幕尺寸小于 800px 时，两列布局改为上下布局 */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    height: 80%;
    padding: 0;
  }
}
 
/* 响应式布局 -屏幕尺寸小于 400px 时，导航等布局改为上下布局 */
@media screen and (max-width: 400px) {
  .topnav a {
    float: none;
    width: 100%;
  }
}
</style>
<script src="/Public/js/jquery-3.3.1.min.js"></script>
</head>
<body>

<!-- <div class="header">
  <h1>我的网页</h1>
</div> -->

<div class="topnav">
  <!-- <a href="#">链接</a>
  <a href="#">链接</a>
  <a href="#">链接</a>
  <a href="#" style="float:right">链接</a> -->
  <h2>元器件出入库管理系统</h2>
</div>

<iframe frameBorder="0" src="<?php echo U('Home/Index/compMain');?>"></ifream>

<!-- <div class="footer">
  <h2>底部区域</h2>
</div> -->

</body>
</html>