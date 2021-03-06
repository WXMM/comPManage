<?php if (!defined('THINK_PATH')) exit();?><html>
<head>

<link rel="stylesheet" type="text/css" href="/Public/other/bootstrap-3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/css/datatables.min.css">
<link href="/Public/css/tableList.css" rel="stylesheet">
<link href="/Public/css/tableDetail.css" rel="stylesheet">
<script src="/Public/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="/Public/other/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="/Public/js/datatables.min.js"></script>
<style>
	#toolBarMenu {
		margin-bottom: 20px;
	}
	#compList .handleCol button {
		margin-right: 10px;
	}
</style>
</head>
<body>
<ul class="breadcrumb" style="background-color:#FFFFFF;padding-left:0px">
    <li><a href="#">用户管理</a></li>
    <li><a href="#">用户列表</a></li>
</ul>
<div id="toolBarMenu">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">新增用户</button>
	
    <div class="form-group" style="float: right">
	    <div class="col-sm-12">
	      <input class="form-control" id="filterName" type="text" value="" placeholder="输入关键字检索，支持模糊查找...">
    </div>
  </div>
	<!-- 模态框（Modal） -->
	<form class="form-horizontal" role="form" id="addUserForm" method="post" action="<?php echo U('Manage/addUser');?>">
		<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLable" aria-hidden="true">
		    <div class="modal-dialog" style="width:90%">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="addDataModalLable">新增用户</h4>
		            </div>
		            <div class="modal-body">					   				   

						    <div class="form-group" style="margin-top:20px">
						      <label for="type" class="col-sm-2 control-label">用户名称</label>
						      <div class="col-sm-8">
						   		 <input type="text" class="form-control username" name="username"
						               placeholder="用户姓名" >
						      </div>
						    </div>

							<div class="form-group" style="margin-top:20px">
						      <label for="tname" class="col-sm-2 control-label">选择权限</label>
						      <div class="col-sm-8">
						         <select class="form-control compType" name="access">
						         	<option value="1">超级管理员</option>
						         	<option value="2">普通用户</option>
						         </select>
						      </div>
						    </div>

						    <div class="form-group" style="margin-top:20px">
						      <label for="type" class="col-sm-2 control-label">输入密码</label>
						      <div class="col-sm-8">
						   		 <input type="password" class="form-control password" name="password"
						               placeholder="密码" >
						      </div>
						    </div>

						    <div class="form-group">
						      <label for="mark" class="col-sm-2 control-label">备&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp注</label>
						      <div class="col-sm-10">
						         <textarea class="form-control" rows="3" name="mark" ></textarea>
						      </div>
						      
						    </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		                <button type="submit" class="btn btn-primary">提交新增</button>
		            </div>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal -->
		</div>
	</form>
</div>


<table id="compList" class="bordered research">
    <thead>
        <tr>
            <th>编号</th>
            <th>姓名</th>
            <th>权限等级</th>
            <th>注册时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
            	<td><?php echo ($k); ?></td>
            	<td><?php echo ($vo["username"]); ?></td>
            	<td>
            		<?php switch($vo["access"]): case "1": ?>超级管理员<?php break;?>
					<?php case "2": ?>普通用户<?php break;?>
					<?php default: ?>默认情况<?php endswitch;?>
				</td>
            	<td><?php echo ($vo["date"]); ?></td>
            	<td style="width:20%" class="handleCol" data-id="<?php echo ($vo["id"]); ?>">
            		<!-- <button type="button" class="btn btn-info btn-sm readBtn">查看</button> -->
            		<!-- <button type="button" class="btn btn-info btn-sm changePsd">修改密码</button> -->
            		<button type="button" class="btn btn-info btn-sm delBtn">删除</button>
            	</td>
        	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
</body>
<script type="text/javascript" charset="utf8" src="/Public/js/jquery.form.min.js"></script>
<script type="text/javascript">

//筛选js
	$("#filterName").keyup(function(){
        $(".research tbody tr")
                .hide()
                .filter(":contains('"+( $(this).val() )+"')")
                .show();
    })

	
	$("#addUserForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认新增？")){}
          else{return false;}
      },  // 提交前
      success: function showResponse(data){
      	  alert(data.msg);
          location.reload();
      }
    })

    $("#compList tbody .delBtn").click(function(){
        if(confirm("是否确认删除？")){
            var id=$(this).parents().attr("data-id");
            $.post("<?php echo U('Manage/delUser');?>",{id:id},function(data){
                alert(data.msg);
                location.reload();
            },"JSON")
        }
    })

</script>
</html>