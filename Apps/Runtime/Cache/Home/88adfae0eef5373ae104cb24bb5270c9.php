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
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">新增元器件</button>

	<button id="importDtaBtn" type="button" class="btn btn-info" >导入数据</button>
	<button id="choseFileBtn" type="button" class="btn btn-info" >选择导入文档</button>
	<label id="choseFileLabel">未选择文件</label>

	<form id="importDtaForm" action="<?php echo U('PHPExcel/upload');?>" enctype="multipart/form-data" method="post" style="display:none">
		<!-- <input type="text" name="name" /> -->
		<input id="choseFileBtnHide" type="file" name="excelFile" />
		<input id="importDtaBtnHide" type="submit" value="提交" >
	</form>

	<div class="form-group" style="float: right">
	    <div class="col-sm-12">
	      <input class="form-control" id="filterName" type="text" value="" placeholder="关键字检索，支持模糊查找...">
    </div>

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
						         	<?php if(is_array($dicConnecttype)): $i = 0; $__LIST__ = $dicConnecttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
						            <?php if(is_array($dicProducer)): $i = 0; $__LIST__ = $dicProducer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" data-linkman="<?php echo ($vo["mark"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						         </select>
						      </div>

						      <label for="producer_linkman" class="col-sm-1 control-label">联系方式</label>
						      <div class="col-sm-3">
						         <input type="text" class="form-control" name="producer_linkman" 
						               placeholder="">
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

<!-- 查看模态框（Modal） -->
<form class="form-horizontal" role="form" id="compReadForm" method="post" action="">
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
			   <div class="form-group" style="margin-top:20px">
			      <label for="tname" class="col-sm-1 control-label">器件名称</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control name" name="name" 
			               placeholder="请输入元器件名称" readonly="readonly">
			      </div>

			      <label for="type" class="col-sm-1 control-label">器件类型</label>
			      <div class="col-sm-3">
			   		 <select class="form-control type" name="type" readonly="readonly">
			         	<?php if(is_array($dicConnecttype)): $i = 0; $__LIST__ = $dicConnecttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			         </select>
			      </div>

			      <label for="standard" class="col-sm-1 control-label">器件规格</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control standard" name="standard"
			               placeholder="请输入元器件规格" readonly="readonly">
			      </div>
			   </div>

			   <div class="form-group">
			      <label for="store_num" class="col-sm-1 control-label">库存数量</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control store_num" name="store_num" placeholder="请输入库存数量" readonly="readonly">
			      </div>

			      <label for="grade" class="col-sm-1 control-label">质量等级</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control grade" name="grade" 
			               placeholder="请输入质量等级" readonly="readonly">
			      </div>

			      <label for="comp_price" class="col-sm-1 control-label">单价(元)</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control comp_price" name="comp_price" 
			               placeholder="请输入单价" readonly="readonly">
			      </div>

			   </div>

			   <div class="form-group">
			      <label for="project_pact" class="col-sm-1 control-label">项目批次</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control project_pact" name="project_pact" 
			               placeholder="请选择项目批次" readonly="readonly">
			      </div>

			      <label for="comp_pact" class="col-sm-1 control-label">元器件批次</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control comp_pact" name="comp_pact" 
			               placeholder="请输入元器件批次" readonly="readonly">
			      </div>

			   </div>
			   <div class="form-group">
			      <label for="producer" class="col-sm-1 control-label">生产厂家</label>
			      <div class="col-sm-3">
			         <select class="form-control producer" name="producer" readonly="readonly">
			            <?php if(is_array($dicProducer)): $i = 0; $__LIST__ = $dicProducer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" data-linkman="<?php echo ($vo["mark"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			         </select>
			      </div>

			      <label for="producer_linkman" class="col-sm-1 control-label">联系方式</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control producer_linkman" name="producer_linkman" 
			               placeholder="" readonly="readonly">
			      </div>
			   </div>
			   

			   <div class="form-group">
			      <label for="bargain_num" class="col-sm-1 control-label">合同编号</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control bargain_num" name="bargain_num" 
			               placeholder="请输入合同编号" readonly="readonly">
			      </div>

			      <label for="certification_num" class="col-sm-1 control-label">合格证号</label>
			      <div class="col-sm-3">
			         <input type="text" class="form-control certification_num" name="certification_num" 
			               placeholder="请输入合格证号" readonly="readonly">
			      </div>
			   </div>

			   <div class="form-group">
			      <label for="mark" class="col-sm-1 control-label mark">备&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp注</label>
			      <div class="col-sm-11">
			         <textarea class="form-control mark" rows="3" name="mark" readonly="readonly"></textarea>
			      </div>
			      
			   </div>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
</form>




<table id="compList" class="bordered research">
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
    	<?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
            	<td><?php echo ($k); ?></td>
            	<td data-type="$vo.type"><?php if(is_array($dicConnecttype)): $i = 0; $__LIST__ = $dicConnecttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voKid): $mod = ($i % 2 );++$i; if(($voKid["id"]) == $vo["type"]): echo ($voKid["name"]); endif; endforeach; endif; else: echo "" ;endif; ?></td>
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


	$("#filterName").keyup(function(){
        $(".research tbody tr")
                .hide()
                .filter(":contains('"+( $(this).val() )+"')")
                .show();
    })
	//选取默认select及对应选项
	var linkman=$("#compAddForm select[name='producer']").find("option:selected").data("linkman");
	$("#compAddForm input[name='producer_linkman']").val(linkman);

	$("#compAddForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认新增？")){}
      },  // 提交前
      success: function showResponse(data){
          alert(data.msg);
          location.reload();
      }
    })

    $("#importDtaForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认上传数据？")){}
      },  // 提交前
      success: function showResponse(data){
          alert(data.msg);
          location.reload();
      }
    })


	$("#compAddForm select[name='producer']").change(function(){
		var linkman=$(this).find("option:selected").data("linkman");
		$("#compAddForm input[name='producer_linkman']").val(linkman);
	});

	$("#compList tbody .readBtn").click(function(){
		var id = $(this).parent().attr("data-id");
		$.post("<?php echo U('Manage/readCompDetail');?>",{id:id},function(data){
	        $("#compReadForm .name").val(data.name);
	        $("#compReadForm .type option[value='"+data.type+"']").attr("selected","selected");
	        $("#compReadForm .standard").val(data.standard);
	        $("#compReadForm .store_num").val(data.store_num);
	        $("#compReadForm .grade").val(data.grade);
	        $("#compReadForm .comp_price").val(data.comp_price);
	        $("#compReadForm .project_pact").val(data.project_pact);
	        $("#compReadForm .comp_pact").val(data.comp_pact);
	        $("#compReadForm .producer option[value='"+data.producer+"']").attr("selected","selected");
	        var producer_linkman = $("#compReadForm .producer option[value='"+data.producer+"']").data("linkman")
	        $("#compReadForm .producer_linkman").val(producer_linkman);
	        $("#compReadForm .bargain_num").val(data.bargain_num);
	        $("#compReadForm .certification_num").val(data.certification_num);
	        $("#compReadForm .mark").val(data.mark);
	    },"JSON")
		$('#myModal').modal("show");
	});

	$("#choseFileBtn").click(function(){
		$("#choseFileBtnHide").trigger('click');
	});

	$("#importDtaBtn").click(function(){
		$("#importDtaBtnHide").trigger('click');
	});

	$("#choseFileBtnHide").bind("input propertychange", function() {
		var fileName = $("#choseFileBtnHide").val();
		var arrSplit = new Array();
		arrSplit = fileName.split('\\');
		$("#choseFileLabel").html(arrSplit.pop());
	});


</script>
</html>