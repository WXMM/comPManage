<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <link href="/Public/css/login.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1>元器件出入库管理系统</h1>

<div class="login" style="margin-top:50px;">
    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 235px;">
        <!--登录-->
        <div class="web_login" id="web_login">
            <div class="login-box">
                <div class="login_form">
                    <form class="form-horizontal"  action='/index.php/Home/Index/check_user' method="post" name="myForm">
                        <input type="hidden" name="did" value="0"/>
                        <input type="hidden" name="to" value="log"/>
                        <div class="uinArea" id="uinArea">
                            <label class="input-tips" for="u">帐号：</label>
                            <div class="inputOuter" id="uArea">
                                <input type="text"  id="u" name="username" class="inputstyle" placeholder="请输入名字"/>
                            </div>
                        </div>
                        <div class="pwdArea" id="pwdArea">
                            <label class="input-tips" for="p">密码：</label>
                            <div class="inputOuter" id="pArea">
                                <input type="password" id="p" name="password" class="inputstyle" placeholder="请输入密码"/>
                            </div>
                        </div>
                        <div style="padding-left:50px;margin-top:20px;"><input type="submit" value="登 录" style="width:150px;" class="button_blue"/></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="advice">*推荐使用ie8或以上版本ie浏览器或Chrome内核浏览器访问本站</div>


</body>
<script src="/Public/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/Public/js/jquery.form.min.js"></script>
<script>
    var options = {
        beforeSubmit:  showRequest,  // 提交前
        success:       showResponse // 提交后
    }
    $('form[name="myForm"]').ajaxForm(options);
    //提交前进行表单验证
    function showRequest(formData){
        for (var i=0; i < formData.length; i++) {
            if (!formData[i].value) {
                alert('用户名,密码都不能为空!');
                return false;
            }
        }
    }
    //提交后进进行相关的操作
    function showResponse(){
        var username=$("input[name='username']").val();
        var password=$("input[name='password']").val();
        $.post('<?php echo U("Index/check_user");?>',{username:username,password:password},function(data){
            if(data=='1'){
                location.href = "<?php echo U('Index/mainIndex');?>";
            }else if(data=='0'){
                alert("密码错误！！");
            }
        },"JSON")
    }
</script>
</html>