<?php
namespace Home\Controller;

use Think\Controller;

class ManageController extends Controller
{
    public function index()
    {
        $this->display();
    }

    public function compManage()
    {

        //初始化字典值
        $dicManage       = M("DicManage");
        
        $wheredic['pid']    = C("DIC_PRODUCERID"); 
        $dicProducer        = $dicManage->where($wheredic)->select();
        $wheredic['pid']    = C("DIC_CONNECTTYPEID");
        $dicConnecttype     = $dicManage->where($wheredic)->select();

        $this->assign('dicProducer',$dicProducer);
        $this->assign('dicConnecttype',$dicConnecttype);



    	$compReserve = D("CompReserve"); // 实例化User对象
		$data = $compReserve->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function compManageEdit()
    {
        //初始化字典值
        $dicManage       = M("DicManage");
        
        $wheredic['pid']    = C("DIC_PRODUCERID"); 
        $dicProducer        = $dicManage->where($wheredic)->select();
        $wheredic['pid']    = C("DIC_CONNECTTYPEID");
        $dicConnecttype     = $dicManage->where($wheredic)->select();

        $this->assign('dicProducer',$dicProducer);
        $this->assign('dicConnecttype',$dicConnecttype);

        $where['id']=I("get.id","");
        $compReserve = D("CompReserve"); 
        $data = $compReserve->where($where)->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function readComp()
    {
        $where['id']=I("get.id","");

        $compReserve = D("CompReserve"); 
        $data = $compReserve->where($where)->select();

        $this->assign('data',$data);
        $this->display();
    }

    public function editComp()
    {
        $where['id']=I("post.id","");
        $where["type"]=I("post.type","");
        $where["name"]=I("post.name","");
        $where["standard"]=I("post.standard","");
        $where["store_num"]=I("post.store_num","");
        $where["producer"]=I("post.producer","");
        $where["project_pact"]=I("post.project_pact",'0');
        $where["comp_pact"]=I("post.comp_pact",'0');
        $where["comp_price"]=I("post.comp_price",'0');
        $where["bargain_num"]=I("post.bargain_num",'0');
        $where["certification_num"]=I("post.certification_num",'0');
        $where["mark"]=I("post.mark",'0');
    
        $compReserve = D("CompReserve");
        $pid=$compReserve->save($where);
        if($pid){
            $re['msg']="修改成功";
        }else{
            $re['msg']="修改出错";
        } 
        
        $this->ajaxReturn($re);

    }

    public function delComp()
    {
        $id=I("post.id","");

        $compReserve = D("CompReserve"); 
        $pid = $compReserve->delete($id);
        if($pid){
            $re['msg']="删除成功";
        }else{
            $re['msg']="删除出错";
        } 
        
        $this->ajaxReturn($re);
    }

    public function addComp()
    {
        $where["type"]=I("post.type","");
        $where["name"]=I("post.name","");
        $where["standard"]=I("post.standard","");
        $where["store_num"]=I("post.store_num","");
        $where["producer"]=I("post.producer","");
        $where["project_pact"]=I("post.project_pact",'0');
        $where["comp_pact"]=I("post.comp_pact",'0');
        $where["comp_price"]=I("post.comp_price",'0');
        $where["bargain_num"]=I("post.bargain_num",'0');
        $where["certification_num"]=I("post.certification_num",'0');
        $where["mark"]=I("post.mark",'0');
    
        $compReserve = D("CompReserve");
        $pid=$compReserve->add($where);
        if($pid){
            $re['msg']="修改成功";
        }else{
            $re['msg']="修改出错";
        } 
        
        $this->ajaxReturn($re);

    }
    
    public function compOut()
    {
    	$User = D("CompReserve"); // 实例化User对象
		$data = $User->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function compIn()
    {
        $this->display();
    }


//字典数据类型名称增删改查

    public function dicManage()
    {

        $dic = M("DicDic"); // 实例化字典对象
        $data = $dic->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function addDic()
    {
        $where["name"]=I("post.name","");
        $where["mark"]=I("post.mark",'0');
    
        $dic = M("DicDic");
        $pid=$dic->add($where);
        if($pid){
            $re['msg']="新增成功";
        }else{
            $re['msg']="新增出错";
        }        
        $this->ajaxReturn($re);

    }

    public function editDic()
    {
        
    
        $where['id']=I("post.id","");
        $where["name"]=I("post.name","");
        $where["mark"]=I("post.mark",'0');
    
        $dic = M("DicDic");
        $pid=$dic->save($where);
        if($pid){
            $re['msg']="修改成功";
        }else{
            $re['msg']="修改出错";
        } 
        
        $this->ajaxReturn($re);  
    }

    public function delDic()
    {
        $id=I("post.id","");

        $dic = M("DicDic");
        $pid = $dic->delete($id);
        if($pid){
            $re['msg']="删除成功";
        }else{
            $re['msg']="删除出错";
        }     
        $this->ajaxReturn($re);
    }

//字典数据类型详细标记

    public function dicManageDetail()
    {

        $pid = I("get.pid","");
        $dic = M("DicDic"); // 实例化字典对象
        $dataDic = $dic->select($pid);
        $this->assign('dataDic',$dataDic);


        $where["pid"] = $pid;
        $dicManage = M("DicManage"); 
        $data = $dicManage->where($where)->select();
        $this->assign('data',$data);
        // $this->assign('id',$id);
        $this->display();
    }

    public function addDicDetail()
    {

        $where["pid"]=I("post.pid","");
        $where["name"]=I("post.name","");
        $where["mark"]=I("post.mark",'0');
    
        $dicManage = M("DicManage");
        $pid=$dicManage->add($where);
        if($pid){
            $re['msg']="新增成功";
        }else{
            $re['msg']="新增出错";
        }        
        $this->ajaxReturn($re);

    }

    public function editDicDetail()
    {
        
    
        $where['id']=I("post.id","");
        $where["name"]=I("post.name","");
        $where["mark"]=I("post.mark",'0');
    
        $dicManage = M("DicManage");
        $pid=$dicManage->save($where);
        if($pid){
            $re['msg']="修改成功";
        }else{
            $re['msg']="修改出错";
        } 
        
        $this->ajaxReturn($re);  
    }

    public function delDicDetail()
    {
        $id=I("post.id","");

        $dicManage = M("DicManage");
        $pid = $dicManage->delete($id);
        if($pid){
            $re['msg']="删除成功";
        }else{
            $re['msg']="删除出错";
        }     
        $this->ajaxReturn($re);
    }


}