<?php
namespace Home\Controller;

use Think\Controller;

class ManageController extends Controller
{
    public function index()
    {
        $this->display();
    }


//建立元器件库相关的控制方法

    //元器件库列表
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

    	$compReserve = D("CompReserve"); 
		$data = $compReserve->select();
        $this->assign('data',$data);

        self::storeManage("test",1);

        $this->display();
    }
    //元器件库编辑页面
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
        // var_dump($data);
        $this->display();
    }

//元器件库详细查看的ajax方法
    public function readCompDetail()
    {

        $this->assign('dicProducer',$dicProducer);
        $this->assign('dicConnecttype',$dicConnecttype);

        $id=I("post.id","");
        $compReserve = D("CompReserve"); 
        $data = $compReserve->find($id);

        $this->ajaxReturn($data);
    }

//元器件库编辑提交ajax方法
    public function editComp()
    {
        $where['id']=I("post.id","");
        $where["type"]=I("post.type","");
        $where["name"]=I("post.name","");
        $where["standard"]=I("post.standard","");
        $where["grade"]=I("post.grade","");
        $where["store_num"]=I("post.store_num","");
        $where["producer"]=I("post.producer","");
        $where["project_pact"]=I("post.project_pact",'');
        $where["comp_pact"]=I("post.comp_pact",'');
        $where["comp_price"]=I("post.comp_price",'0');
        $where["bargain_num"]=I("post.bargain_num",'');
        $where["certification_num"]=I("post.certification_num",'');
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
//删除元器件库项
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

//新增元器件ajax方法
    public function addComp()
    {
        $where["type"]=I("post.type","");
        $where["name"]=I("post.name","");
        $where["standard"]=I("post.standard","");
        $where["grade"]=I("post.grade","");
        $where["store_num"]=I("post.store_num","");
        $where["producer"]=I("post.producer","");
        $where["project_pact"]=I("post.project_pact",'');
        $where["comp_pact"]=I("post.comp_pact",'');
        $where["comp_price"]=I("post.comp_price",'0');
        $where["bargain_num"]=I("post.bargain_num",'');
        $where["certification_num"]=I("post.certification_num",'');
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


//元器件出库清单列表页面  
    public function compOut()
    {
        $compOut = D("CompOut");
        $data = $compOut->relation(true)->order('date desc')->select();
        $this->assign('data',$data);


        $compReserve = D("CompReserve"); 
        $compType = $compReserve->select();
        $this->assign('compType',$compType);


        $dicManage       = M("DicManage");
        
        $wheredic['pid']    = C("DIC_PRODUCERID"); 
        $dicProducer        = $dicManage->where($wheredic)->select();
        $wheredic['pid']    = C("DIC_CONNECTTYPEID");
        $dicConnecttype     = $dicManage->where($wheredic)->select();

        $this->assign('dicProducer',$dicProducer);
        $this->assign('dicConnecttype',$dicConnecttype);


        // var_dump($data);
        $this->display();
    }

//新增元器件出库
    public function addCompOut()
    {

        $where["comp_id"]=I("post.comp_id","");
        $where["outNum"]=I("post.outNum","");
        $where["remain"]=I("post.store_num","")-I("post.outNum","");
        $where["user"]=I("post.user","");
        $where["manageer"]=cookie('username');
        
        $where["date"]=date("Y-m-d H:i:s");
        $where["mark"]=I("post.mark","");

        $compOut = D("CompOut");
        $res=$compOut->add($where);
        if($res){
            //减库存
            $remain = self::storeManage($where["comp_id"],$where["outNum"],2);
            $re['msg'] = "修改成功";
            $re['remain'] = $remain;
        }else{
            $re['msg']="修改出错";
        } 
        
        $this->ajaxReturn($re);
    }

//删除元器件出库操作
    public function delCompOut()
    {
        
        $id=I("post.id","");
        $compOut = D("CompOut");
        $outnum  = $compOut->where(array('id' => $id))->find();
        $res = $compOut->delete($id);
        if($res){
            //恢复库存
            $remaining = self::storeManage($outnum['comp_id'],$outnum['outnum'],1);
            $re['flag']   = 1;
            $re['msg']    = "删除成功";
            $re['remain'] = $remaining;
        }else{
            $re['flag'] = 1;
            $re['msg']="删除出错";
        } 
        
        $this->ajaxReturn($re);
    }


//元器件入库清单列表页面
    public function compIn()
    {
        $compIn = D("CompIn");
        $data = $compIn->relation(true)->select();
        $this->assign('data',$data);

        $compReserve = D("CompReserve"); 
        $compType = $compReserve->select();
        $this->assign('compType',$compType);


        $dicManage       = M("DicManage");
        
        $wheredic['pid']    = C("DIC_PRODUCERID"); 
        $dicProducer        = $dicManage->where($wheredic)->select();
        $wheredic['pid']    = C("DIC_CONNECTTYPEID");
        $dicConnecttype     = $dicManage->where($wheredic)->select();

        $this->assign('dicProducer',$dicProducer);
        $this->assign('dicConnecttype',$dicConnecttype);

        $this->display();
    }


//新增元器件入库
    public function addCompIn()
    {

        $where["comp_id"]=I("post.comp_id","");
        $where["innum"]=I("post.inNum","");
        $where["remain"]=I("post.store_num","")+I("post.inNum","");
        $where["user"]=I("post.user","");
        $where["manageer"]=cookie('username');
        
        $where["date"]=date("Y-m-d H:i:s");
        $where["mark"]=I("post.mark","");

        $compOut = D("CompIn");
        $res=$compOut->add($where);
        if($res){
            //加库存
            $remain = self::storeManage($where["comp_id"],$where["innum"],1);
            $re['msg']="修改成功";
            $re['remain'] = $remain;
        }else{
            $re['msg']="修改出错";
        } 
        
        $this->ajaxReturn($re);
    }

//删除元器件入库
    public function delCompIn()
    {
        
        $id=I("post.id","");

        $compIn = D("CompIn"); 
        $innum  = $compIn->where(array('id' => $id))->find();
        $res = $compIn->delete($id);

        if($res){
            //去除库存
            $remaining = self::storeManage($innum['comp_id'],$innum['innum'],2);
            $re['msg']="删除成功";
            $re['remain'] = $remaining;
        }else{
            $re['msg']="删除出错";
        } 
        
        $this->ajaxReturn($re);
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

    public function storeManage($id,$num,$mode){
        $compManage = M("CompReserve");
        $storenum =  $compManage->where(array('id' => $id))->getField("store_num");
        
        //mode为1是表示加库存  mode为2时表示减库存
        if($mode==1){
            $storenum = $storenum+$num;
        }else{
            $storenum = $storenum-$num;
        }
        $compManage->save(array('id' => $id,'store_num' => $storenum));
        return $storenum;
    }

// 用户管理操作
    public function userManage()
    {
        
        $user = M("User"); 
        $data = $user->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function addUser()
    {
        
        $where["username"]=I("post.username","");
        $where["password"]=md5(I("post.password",""));
        $where["access"]=I("post.access","");
        $where["date"]=date("Y-m-d H:i:s");
        $where["mark"]=I("post.mark",'0');
    
        $user = M("User");

        $pid=$user->add($where);
        if($pid){
            $re['msg']="新增成功";
        }else{
            $re['msg']="新增出错";
        }        
        $this->ajaxReturn($re);
    }

    public function delUser()
    {
        
        $id=I("post.id","");
        $user = M("User");

        $pid=$user->delete($id);
        if($pid){
            $re['msg']="删除成功";
        }else{
            $re['msg']="删除出错";
        }        
        $this->ajaxReturn($re);
    }


}