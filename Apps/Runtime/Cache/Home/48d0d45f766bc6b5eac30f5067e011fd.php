<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>元器件库编辑</title>
	<link rel="stylesheet" type="text/css" href="/Public/other/bootstrap-3.3.7/css/bootstrap.min.css">
   <script src="/Public/js/jquery-3.3.1.min.js"></script>
   <script type="text/javascript" charset="utf8" src="/Public/other/bootstrap-3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form class="form-horizontal" role="form" id="compEditForm">
   

   
   <div class="form-group">
      <label for="tname" class="col-sm-1 control-label">器件名称</label>
      <div class="col-sm-3">
         <input type="hidden"  name="id"  value="<?php echo ($data[0]["id"]); ?>">
         <input type="text" class="form-control" name="name" 
               placeholder="请输入元器件名称" value="<?php echo ($data[0]["name"]); ?>">
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
               placeholder="请输入元器件规格" value="<?php echo ($data[0]["standard"]); ?>">
      </div>
   </div>

   <div class="form-group">
      <label for="store_num" class="col-sm-1 control-label">库存数量</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="store_num" 
               placeholder="请输入库存数量" value="<?php echo ($data[0]["store_num"]); ?>">
      </div>

      <label for="grade" class="col-sm-1 control-label">质量等级</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="grade" 
               placeholder="请选择质量等级" value="<?php echo ($data[0]["grade"]); ?>">
      </div>

      <label for="comp_price" class="col-sm-1 control-label">单价(元)</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="comp_price" 
               placeholder="请输入单价" value="<?php echo ($data[0]["comp_price"]); ?>">
      </div>

   </div>

   <div class="form-group">
      <label for="project_pact" class="col-sm-1 control-label">项目批次</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="project_pact" 
               placeholder="请选择项目批次" value="<?php echo ($data[0]["project_pact"]); ?>">
      </div>

      <label for="comp_pact" class="col-sm-1 control-label">元器件批次</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="comp_pact" 
               placeholder="请输入元器件批次" value="<?php echo ($data[0]["comp_pact"]); ?>">
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
               placeholder="请输入联系人" value="<?php echo ($data[0]["producer_linkman"]); ?>">
      </div>

      <label for="producer_linkman_phone" class="col-sm-1 control-label">联系电话</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="producer_linkman_phone" 
               placeholder="请输入联系人电话" value="<?php echo ($data[0]["producer_linkman_phone"]); ?>">
      </div>
   </div>
   

   <div class="form-group">
      <label for="bargain_num" class="col-sm-1 control-label">合同编号</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="bargain_num" 
               placeholder="请输入合同编号" value="<?php echo ($data[0]["bargain_num"]); ?>">
      </div>

      <label for="certification_num" class="col-sm-1 control-label">合格证号</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" name="certification_num" 
               placeholder="请输入合格证号" value="<?php echo ($data[0]["certification_num"]); ?>">
      </div>
   </div>

   <div class="form-group">
      <label for="mark" class="col-sm-1 control-label">备&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp注</label>
      <div class="col-sm-11">
         <textarea class="form-control" rows="3" name="mark"><?php echo ($data[0]["mark"]); ?></textarea>
      </div>
      
   </div>
   
</form>
</body>
<script type="text/javascript" charset="utf8" src="/Public/js/jquery.form.min.js"></script>
<script>
   $("#compEditForm").ajaxForm({
      beforeSubmit:  function showRequest(){
          if(confirm("确认修改？")){}
      },  // 提交前
      success: function showResponse(data){
          alert(data.msg);
          location.reload();
      }
   })
</script>
</html>