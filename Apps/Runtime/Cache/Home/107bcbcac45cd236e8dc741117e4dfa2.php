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
<script type="text/javascript">

	$(document).ready( function () {

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
            if(confirm("删除出库信息，将会恢复减少的库存，是否继续？")){
                var id=$(this).parents().data("id");
                $.post("<?php echo U('Manage/delCompOut');?>",{id:id},function(data){
                    alert(data.msg+" 剩余库存："+ data.remain);
                    location.reload();
                },"JSON")
            }
        })
	    
	});	
</script>
</head>
<body>
<ul class="breadcrumb" style="background-color:#FFFFFF;padding-left:0px">
    <li><a href="#">出库管理</a></li>
    <li><a href="#">出库列表</a></li>
</ul>
<div id="toolBarMenu">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">新增出库</button>
	
    <div class="form-group" style="float: right">
	    <div class="col-sm-12">
	      <input class="form-control" id="filterName" type="text" value="" placeholder="输入关键字检索，支持模糊查找...">
    </div>
  </div>
	<!-- 模态框（Modal） -->
	<form class="form-horizontal" role="form" id="compAddOutForm" method="post" action="<?php echo U('Manage/addCompOut');?>">
		<div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLable" aria-hidden="true">
		    <div class="modal-dialog" style="width:90%">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title" id="addDataModalLable">新增出库</h4>
		            </div>
		            <div class="modal-body">					   				   
						   <div class="form-group" style="margin-top:20px">
						      <label for="tname" class="col-sm-2 control-label">选择器件</label>
						      <div class="col-sm-8">
						      	<input type="hidden" class="form-control comp_id" name="comp_id">
						         <select class="form-control compType">
						         	<option>----点击选择元器件----</option>
						         	<?php if(is_array($compType)): $i = 0; $__LIST__ = $compType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  data-id="<?php echo ($vo["id"]); ?>" data-store="<?php echo ($vo["store_num"]); ?>">名称：<?php echo ($vo["name"]); ?>&nbsp&nbsp&nbsp规格：<?php echo ($vo["standard"]); ?>&nbsp&nbsp&nbsp批次：<?php echo ($vo["comp_pact"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						         	
						         </select>
						      </div>
						    </div>

						   <div class="form-group">
						      <label for="type" class="col-sm-2 control-label">库存剩余</label>
						      <div class="col-sm-8">
						   		 <input type="text" class="form-control store_num" name="store_num"
						               placeholder="库存剩余" readonly="readonly">
						      </div>

						   </div>

						   <div class="form-group">
						      <label for="outNum" class="col-sm-2 control-label">出库数量</label>
						      <div class="col-sm-8">
						         <input type="text" class="form-control outNum" name="outNum" placeholder="出库数量不能大于已有库存" >
						      </div>
						    </div>

						   <div class="form-group">
						      <label for="grade" class="col-sm-2 control-label">使用对象</label>
						      <div class="col-sm-8">
						         <input type="text" class="form-control user" name="user" 
						               placeholder="请输入使用对象" >
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
            <th>种类</th>
            <th>名称</th>
            <th>规格</th>
            <th>新增出库</th>
            <th>此次结余</th>
            <th>剩余库存</th>
            <th>项目批次</th>
            <th>元器件批次</th>
            <th>使用对象</th>
            <th>操作人员</th>
            <th>出库时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
            	<td><?php echo ($k); ?></td>
            	<td data-type="$vo.compReserve.type" class="type">
            		<?php if(is_array($dicConnecttype)): $i = 0; $__LIST__ = $dicConnecttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voKid): $mod = ($i % 2 );++$i; if(($voKid["id"]) == $vo["compReserve"]["type"]): echo ($voKid["name"]); endif; endforeach; endif; else: echo "" ;endif; ?>
            	</td>
            	<td><?php echo ($vo["compReserve"]["name"]); ?></td>
            	<td><?php echo ($vo["compReserve"]["standard"]); ?></td>
            	<td><?php echo ($vo["outnum"]); ?></td>
            	<td><?php echo ($vo["remain"]); ?></td>
            	<td><?php echo ($vo["compReserve"]["store_num"]); ?></td>
            	<td><?php echo ($vo["compReserve"]["project_pact"]); ?></td>
            	<td><?php echo ($vo["compReserve"]["comp_pact"]); ?></td>
            	<td><?php echo ($vo["user"]); ?></td>
            	<td><?php echo ($vo["manageer"]); ?></td>
            	<td><?php echo ($vo["date"]); ?></td>
            	<td style="width:20%" class="handleCol" data-id="<?php echo ($vo["id"]); ?>">
            		<!-- <button type="button" class="btn btn-info btn-sm readBtn">查看</button> -->
            		<button type="button" class="btn btn-info btn-sm exportBtn">导出报告</button>
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

	
	$("#compAddOutForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认新增？")){
          	var store = $("#compAddOutForm .store_num").val();
          	var outnum = $("#compAddOutForm .outNum").val();
          	if(Number(outnum) > Number(store)){
          		alert("出库数量大于库存数量，请修改出库数量！！！");
          		return false;
          	}
          }
      },  // 提交前
      success: function showResponse(data){
      	  alert(data.msg+" 剩余库存："+ data.remain);
          location.reload();
      }
    })



	$("#addDataModal .compType").click(function(){
		var compId=$(this).find("option:selected").data("id");
		var store=$(this).find("option:selected").data("store");
		$("#addDataModal .comp_id").val(compId);
		$("#addDataModal .store_num").val(store);
		
	});

</script>
</html>