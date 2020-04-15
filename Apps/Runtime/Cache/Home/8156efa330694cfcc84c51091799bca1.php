<?php if (!defined('THINK_PATH')) exit();?><html>
<head>

<link rel="stylesheet" type="text/css" href="/Public/other/bootstrap-3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/Public/css/datatables.min.css">
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
<script type="text/javascript">

	$(document).ready( function () {
	    $('#compList').DataTable({
	        "language": {
	            "sProcessing": "处理中...",
		        "sLengthMenu": "显示 _MENU_ 项结果",
		        "sZeroRecords": "没有匹配结果",
		        "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
		        "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
		        "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
		        "sInfoPostFix": "",
		        "sSearch": "搜索:",
		        "sUrl": "",
		        "sEmptyTable": "表中数据为空",
		        "sLoadingRecords": "载入中...",
		        "sInfoThousands": ",",
		        "oPaginate": {
		            "sFirst": "首页",
		            "sPrevious": "上页",
		            "sNext": "下页",
		            "sLast": "末页"
		        },
		        "oAria": {
		            "sSortAscending": ": 以升序排列此列",
		            "sSortDescending": ": 以降序排列此列"
		        }

	        }
    	});
	    
	} );
	
</script>
</head>
<body>
<ul class="breadcrumb" style="background-color:#FFFFFF;padding-left:0px">
    <li><a href="#">字典管理</a></li>
    <li><a href="#">字典类型列表</a></li>

</ul>

<div id="toolBarMenu">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">新增数据</button>
	<!-- 模态框（Modal） -->
	<form class="form-horizontal" role="form" id="dicAddForm" method="post" action="<?php echo U('Manage/addDic');?>">
		<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLable" aria-hidden="true">
		    <div class="modal-dialog" style="width:50%">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="addDataModalLable">新增字典类型</h4>
		            </div>
		            <div class="modal-body">					   				   
						   <div class="form-group" style="margin-top:20px">
						      <label for="tname" class="col-sm-2 control-label">字典类型</label>
						      <div class="col-sm-9">
						         <input type="text" class="form-control" name="name" 
						               placeholder="请输入字典名称" >
						      </div>
						   </div>

						   <div class="form-group">
						      <label for="mark" class="col-sm-2 control-label">备&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp注</label>
						      <div class="col-sm-9">
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

	<form class="form-horizontal" role="form" id="dicEditForm" method="post" action="<?php echo U('Manage/editDic');?>">
		<div class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalLable" aria-hidden="true">
		    <div class="modal-dialog" style="width:50%">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="editDataModalLable">修改字典类型</h4>
		            </div>
		            <div class="modal-body">					   				   
						   <div class="form-group" style="margin-top:20px">
						      <label for="tname" class="col-sm-2 control-label">字典类型</label>
						      <div class="col-sm-9">
						      	<input type="hidden"  name="id"  value="">
						        <input type="text" class="form-control" name="name" 
						               placeholder="请输入字典名称" >
						      </div>
						   </div>

						   <div class="form-group">
						      <label for="mark" class="col-sm-2 control-label">备&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp注</label>
						      <div class="col-sm-9">
						         <textarea class="form-control" rows="3" name="mark" ></textarea>
						      </div>
						      
						   </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		                <button type="submit" class="btn btn-primary">提交修改</button>
		            </div>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal -->
		</div>
	</form>
</div>

<table id="compList" class="table table-striped">
    <thead>
        <tr>
            <th>编号</th>
            <th>字典类型</th>
            <th>备注说明</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            	<td><?php echo ($vo["id"]); ?></td>
            	<td><?php echo ($vo["name"]); ?></td>
            	<td><?php echo ($vo["mark"]); ?></td>
            	<td style="width:20%" class="handleCol" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" data-mark="<?php echo ($vo["mark"]); ?>">
            		<button type="button" class="btn btn-info btn-sm editValBtn">编辑值</button>
            		<button type="button" class="btn btn-info btn-sm editBtn">修改</button>
            		<button type="button" class="btn btn-info btn-sm delBtn">删除</button>
            	</td>
        	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
</body>
<script type="text/javascript" charset="utf8" src="/Public/js/jquery.form.min.js"></script>
<script type="text/javascript">
	$("#dicAddForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认新增？")){}
      },  // 提交前
      success: function showResponse(data){
          alert(data.msg);
          location.reload();
      }
    })

    $("#dicEditForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认修改？")){}
      },  // 提交前
      success: function showResponse(data){
          alert(data.msg);
          location.reload();
      }
    })

	$("#compList tbody .editBtn").click(function(){
		var id   = $(this).parent().attr("data-id");
		var name = $(this).parent().attr("data-name");
		var mark = $(this).parent().attr("data-mark");
		$("#dicEditForm input[name='id']").val(id);
		$("#dicEditForm input[name='name']").val(name);
		$("#dicEditForm textarea[name='mark']").val(mark);
		$("#editDataModal").modal("show");
	});


	$("#compList tbody .delBtn").click(function(){
        if(confirm("是否确认删除？")){
            var id=$(this).parents().attr("data-id");
            $.post("<?php echo U('Manage/delDic');?>",{id:id},function(data){
                alert(data.msg);
                location.reload();
            },"JSON")
        }
    })

    $("#compList tbody .editValBtn").click(function(){
		var pid = $(this).parent().attr("data-id");
		window.location.href = "<?php echo U('Home/Manage/dicManageDetail/pid/"+pid+"');?>";
	});
</script>
</html>