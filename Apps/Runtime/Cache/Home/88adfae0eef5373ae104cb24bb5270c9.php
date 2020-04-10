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

    	$("#compList tbody .editBtn").click(function(){
    		var id = $(this).parent().attr("data-id");
    		window.location.href = "<?php echo U('Home/Manage/compManageEdit/id/"+id+"');?>";
 		 });

    	$("#compList tbody .readBtn").click(function(){
    		var id = $(this).parent().attr("data-id");
    		$('#readDtaFrame').attr('src',"<?php echo U('Home/Manage/readComp/id/"+id+"');?>");
    		$('#myModal').modal("show");
 		 });

    	$("#compList tbody .delBtn").click(function(){
            if(confirm("是否确认删除？")){
                var id=$(this).parents().attr("data-id");
                $.post("<?php echo U('Manage/delComp');?>",{id:id},function(data){
                    alert(data.msg);
                    location.reload();
                },"JSON")
            }
        })
	    
	} );
	
</script>
</head>
<body>
<ul class="breadcrumb" style="background-color:#FFFFFF;padding-left:0px">
    <li><a href="#">元器件库</a></li>
    <li><a href="#">元器件列表</a></li>
</ul>
<div id="toolBarMenu">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">新增数据</button>
	<!-- 模态框（Modal） -->
	<form class="form-horizontal" role="form" id="compAddForm" method="post" action="<?php echo U('Manage/addComp');?>">
		<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLable" aria-hidden="true">
		    <div class="modal-dialog" style="width:90%">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="addDataModalLable">新增元器件</h4>
		            </div>
		            <div class="modal-body">					   				   
						   <div class="form-group" style="margin-top:20px">
						      <label for="tname" class="col-sm-1 control-label">器件名称</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="name" 
						               placeholder="请输入元器件名称" >
						      </div>

						      <label for="type" class="col-sm-1 control-label">器件类型</label>
						      <div class="col-sm-3">
						         <select class="form-control" name="type">
						            <option>类型1</option>
						            <option>类型2</option>
						            <option>3</option>
						            <option>4</option>
						            <option>5</option>
						         </select>
						      </div>

						      <label for="standard" class="col-sm-1 control-label">器件规格</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="standard"
						               placeholder="请输入元器件规格" >
						      </div>
						   </div>

						   <div class="form-group">
						      <label for="store_num" class="col-sm-1 control-label">库存数量</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="store_num" placeholder="请输入库存数量" >
						      </div>

						      <label for="grade" class="col-sm-1 control-label">质量等级</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="grade" 
						               placeholder="请选择质量等级" >
						      </div>

						      <label for="comp_price" class="col-sm-1 control-label">单价(元)</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="comp_price" 
						               placeholder="请输入单价" >
						      </div>

						   </div>

						   <div class="form-group">
						      <label for="project_pact" class="col-sm-1 control-label">项目批次</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="project_pact" 
						               placeholder="请选择项目批次" >
						      </div>

						      <label for="comp_pact" class="col-sm-1 control-label">元器件批次</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="comp_pact" 
						               placeholder="请输入元器件批次" >
						      </div>

						   </div>
						   <div class="form-group">
						      <label for="producer" class="col-sm-1 control-label">生产厂家</label>
						      <div class="col-sm-3">
						         <select class="form-control" name="producer">
						            <option>1</option>
						            <option>2</option>
						            <option>3</option>
						            <option>4</option>
						            <option>5</option>
						         </select>
						      </div>

						      <label for="producer_linkman" class="col-sm-1 control-label">联系人</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="producer_linkman" 
						               placeholder="请输入联系人">
						      </div>

						      <label for="producer_linkman_phone" class="col-sm-1 control-label">联系电话</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="producer_linkman_phone" 
						               placeholder="请输入联系人电话">
						      </div>
						   </div>
						   

						   <div class="form-group">
						      <label for="bargain_num" class="col-sm-1 control-label">合同编号</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="bargain_num" 
						               placeholder="请输入合同编号" >
						      </div>

						      <label for="certification_num" class="col-sm-1 control-label">合格证号</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="certification_num" 
						               placeholder="请输入合格证号" >
						      </div>
						   </div>

						   <div class="form-group">
						      <label for="mark" class="col-sm-1 control-label">备&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp注</label>
						      <div class="col-sm-11">
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

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					查看元器件
				</h4>
			</div>
			<div class="modal-body">
				<iframe id="readDtaFrame" frameBorder="0" src="" style="width:100%;height:100%"></iframe>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>

<table id="compList" class="table table-striped">
    <thead>
        <tr>
            <th>编号</th>
            <th>种类</th>
            <th>名称</th>
            <th>规格</th>
            <th>库存数量</th>
            <th>所属项目</th>
            <th>批次</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            	<td><?php echo ($vo["id"]); ?></td>
            	<td><?php echo ($vo["type"]); ?></td>
            	<td><?php echo ($vo["name"]); ?></td>
            	<td><?php echo ($vo["standard"]); ?></td>
            	<td><?php echo ($vo["store_num"]); ?></td>
            	<td><?php echo ($vo["project_pact"]); ?></td>
            	<td><?php echo ($vo["comp_pact"]); ?></td>
            	<td style="width:20%" class="handleCol" data-id="<?php echo ($vo["id"]); ?>">
            		<button type="button" class="btn btn-info btn-sm readBtn">查看</button>
            		<button type="button" class="btn btn-info btn-sm editBtn">编辑</button>
            		<button type="button" class="btn btn-info btn-sm delBtn">删除</button>
            	</td>
        	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
</body>
<script type="text/javascript" charset="utf8" src="/Public/js/jquery.form.min.js"></script>
<script type="text/javascript">
	$("#compAddForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认新增？")){}
      },  // 提交前
      success: function showResponse(data){
          alert(data.msg);
          location.reload();
      }
   })

</script>
</html>