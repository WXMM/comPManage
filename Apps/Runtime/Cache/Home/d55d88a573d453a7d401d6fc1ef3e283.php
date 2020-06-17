<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>元器件管理系统</title>
<link rel="stylesheet" type="text/css" href="/Public/other/bootstrap-3.3.7/css/bootstrap.min.css">
<style>
* {
  box-sizing: border-box;
}
 
body {
  font-family: Arial;
  /*padding: 10px;*/
  background: #f1f1f1;
  color:#FFFFFF;
}
 
.navbar-inverse {
  /*background-color:#0b80c9;*/
  /*border-color:#0b80c9;*/
  border-radius:0px;
  color:#FFFFFF;
  margin: 0px;
} 

.card iframe {
	width: 100%;
  /*height: 100%;*/
	height: 800px;
  display: block;
}

.card {
  background-color: white;
  padding: 20px;
  /*margin-top: 20px;*/
  /*height: 100%;*/
  min-height: 600px;
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
<script type="text/javascript" charset="utf8" src="/Public/other/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/other/bootstrap-3.3.7/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="/Public/js/jquery.form.min.js"></script>
<script>
  $(document).ready( function () {
    $("#loginBtn").click(function(){
      $("#addDataModal").modal();
    });

    $("#loginForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认新增？")){
            var usn  = $("#loginForm .username").val();
            var psw  = $("#loginForm .password").val();
            var psw2 = $("#loginForm .passwordConfirm").val();
            if(usn==""){
              alert("用户名不能为空！");
              return false;
            } else if(psw==""){
              alert("密码不能为空！");
              return false;
            }else if(psw!=psw2){
              alert("两次密码不一致！");
              return false;
            }  
          }
      },  // 提交前
      success: function showResponse(data){
          alert(data.msg);
          location.reload();
      }
    })


  });
</script>

</head>
<body>

<!-- 注册用户modal -->

<form class="form-horizontal" role="form" id="loginForm" method="post" action="<?php echo U('Index/loginUser');?>">
  <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLable" aria-hidden="true">
      <div class="modal-dialog" style="width:50%">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="addDataModalLable">注册用户</h4>
              </div>
              <div class="modal-body">                       

             <div class="form-group">
                <label for="project_pact" class="col-sm-2 control-label">用户</label>
                <div class="col-sm-8">
                   <input type="text" class="form-control username" name="username" 
                         placeholder="请输入用户名" value="">
                </div>

             </div>

             <div class="form-group">

                <label for="comp_pact" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-8">
                   <input type="password" class="form-control password" name="password" placeholder="请输入密码" value="">
                </div>

             </div>

             <div class="form-group">

                <label for="comp_pact" class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-8">
                   <input type="password" class="form-control passwordConfirm" name="passwordConfirm" placeholder="请再次输入密码" value="">
                </div>

             </div>
             

             <div class="form-group">
                <label for="mark" class="col-sm-2 control-label">备注</label>
                <div class="col-sm-8">
                   <textarea class="form-control" rows="3" name="mark" placeholder="只能由超级管理员创建普通用户，因此不需要选择权限,这里可以填写用户说明"></textarea>
                </div>
                
             </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                  <button type="submit" class="btn btn-primary">新增用户</button>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div>
</form>


<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">元器件管理系统</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">欢迎你 <?php echo ($username); ?></a></li>
      <?php switch($access): case "1": ?><li><a href="#" id="loginBtn"><span class="glyphicon glyphicon-log-in"></span> 注册</a></li><?php break; endswitch;?>
      <li><a href="loginIndex.html"><span class="glyphicon glyphicon-log-in"></span> 退出</a></li>
    </ul>
  </div>
</nav>


<div class="card">
  <iframe scrolling="no" frameBorder="0" src="<?php echo U('Home/Index/compMain');?>"></ifream>
</div>

</body>


<script>
//   $("#loginForm").ajaxForm({
//       beforeSubmit:  function showRequest(){
//           if(confirm("新增用户？")){
//             
//           }
//       },  // 提交前
//       success: function showResponse(data){
//           alert(data.msg);
//           location.reload();
//       }
//    })

    
</script>
</html>