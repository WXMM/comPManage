<?php if (!defined('THINK_PATH')) exit();?><html>
出库管理
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["id"]); ?>:<?php echo ($vo["name"]); ?><br/><?php endforeach; endif; else: echo "" ;endif; ?>
</html>