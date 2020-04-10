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
    	$compReserve = D("CompReserve"); // 实例化User对象
		$data = $compReserve->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function compManageEdit()
    {
        $where['id']=I("get.id","");

        $compReserve = D("CompReserve"); 
        $data = $compReserve->where($where)->select();

        $this->assign('data',$data);
        // $this->assign('id',$id);
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

    public function dicManage()
    {
        $this->display();
    }
}