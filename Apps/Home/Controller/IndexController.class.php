<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        // $this->display();
        $this->redirect('loginIndex');
    }

    public function loginIndex()
    {
        $this->display();
    }

    public function check_user(){
        $username = I("post.username","");
        $password = I("post.password","");

        $user     = M("User");
        $userpsd  = $user->where(array('username' => $username))->find(); 

        if(md5($password)==$userpsd['password']){
            $data = 1;
        }else{
            $data = 0;
        }

        cookie('username',$username);
        cookie('access',$userpsd['access']);

        $this->ajaxReturn($data);
    }
    //注册新用户
    public function loginUser(){
        $user     = M("User");

        $username = I("post.username","");
        $password = I("post.password","");
        $mark     = I("post.mark","");



        $res = $user->where(array('username' => $username))->count();
        if($res>0){
            $data['msg'] = "该用户已存在";
            $this->ajaxReturn($data);
            return false;
        }else{
            $whereArr = array(
                'username' => $username,
                'password' => md5($password),
                'date'     => date("Y-m-d H:i:s"),
                'access'   => 2,
                'mark'     => $mark,
                );
            $res = $user->add($whereArr);
            if($res) $data['msg']="注册成功";
            else $data['msg']="注册失败";
        }
        $this->ajaxReturn($data);
    }

    public function mainIndex()
    {
        $this->assign('username',cookie('username'));
        $this->assign('access',cookie('access'));
        $this->display();
    }

    public function compMain()
    {
        $this->display();
    }
}