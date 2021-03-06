<?php

class UserAction extends Action {
    public function _empty()
    {
        header("HTTP/1.0 404 Not Found");
        $this->display('Public:404');
    }

    // 显示注册页
    public function reg() {
        if(session('?user_a'))
            $this->redirect('__APP__/index');
        else
            $this->display();
    }

    // 显示登录页
    public function login() {
        if(session('?user_a'))
            $this->redirect('__APP__/index');
        else
            $this->display();
    }

    // 显示用户页
    public function profile() {
        if(session('?user_a'))
        {
            $User = M("User");

            // 构造查询条件
            $condition['id'] = session('user_id');
            // 查询数据
            $list = $User->where($condition)->find();

            if($list['image'] != "")
                $this->assign('image',$list['image']);
            else
                $this->assign('image',C("DEFAULT_AVATAR"));

            $this->assign('username',$list['username']);
            $this->assign('description',$list['description']);

            // 查询所有回复中有无提到登录用户
            $Notification = M('ReplyToCertainUsers');
            $unviewedReplies = $Notification->where('user_id = ' . session('user_id') . ' AND ' . 'viewed = 0')->count();
            $this->assign('unviewedReplies',$unviewedReplies);

            $this->display();
        }
        else
            $this->redirect('__APP__/index');
    }

    // 修改密码页
    public function password() {
        if(session('?user_a'))
        {
            $User = M("User");

            // 构造查询条件
            $condition['id'] = session('user_id');
            // 查询数据
            $list = $User->where($condition)->find();

            if($list['image'] != "")
                $this->assign('image',$list['image']);
            else
                $this->assign('image',C("DEFAULT_AVATAR"));

            $this->assign('username',$list['username']);
            $this->assign('description',$list['description']);

            // 查询所有回复中有无提到登录用户
            $Notification = M('ReplyToCertainUsers');
            $unviewedReplies = $Notification->where('user_id = ' . session('user_id') . ' AND ' . 'viewed = 0')->count();
            $this->assign('unviewedReplies',$unviewedReplies);

            $this->display();
        }
        else
            $this->redirect('__APP__/index');
    }

    // 登录动作
    public function dologin(){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $w['email']=array('eq',$email);
        $rset = M("User")->where($w)->find();

        if(!$rset){
            $this->ajaxReturn('','邮箱不存在！',0);

            return false;
        }else{
            if($rset['password']==$password){
                $data['status'] = 1;
                $result = M("User")->where($w)->save($data);

                session('user_a',$rset['username']);
                session('user_id',$rset['id']);

                $this->ajaxReturn('','/index',1);

            }else {
                $this->ajaxReturn('','密码错误！',0);

            }
        }
    }

    // 退出动作
    public function logout(){
        $data['status'] = 0;
        $w['id']=array('eq',session('user_id'));
        $result = M("User")->where($w)->save($data);
        session('user_a',null);
        session('user_id',null);
        $this->redirect('/index');
    }

    // 写入用户动作
    public function save() {
        $UserD = D("User");
        $result = $UserD->create();
        if($result) {
            if ( empty($result['id']) ) {
                unset($result['id']);
                $return = $UserD ->add($result);
                $id = $return;
            }else {
                $id = $result['id'];
                $return = $UserD ->where( array('id'=>$id) )->save($result);
            }

            session('user_a',$result["username"]);
            session('user_id',$id);

            if ($return) {
                $this->ajaxReturn('/index','保存成功！',1);
            } else {
                $this->ajaxReturn('','数据写入错误！',0);
            }
        } else {
            $this->ajaxReturn('',$UserD->getError(),0);
        }
    }

    // 更新用户动作
    public function edit() {
        $Dao = M("User");

        // 需要更新的数据
        $data['username'] = trim($_POST["username"]);
        $data['description'] = trim($_POST["description"]);
        // 更新的条件
        $condition['id'] = session('user_id');
        $result = $Dao->where($condition)->save($data);
        session('user_a',trim($_POST["username"]));
        if($result !== false){
            $this->ajaxReturn(session('user_a'),'信息更新成功!',1);
        }else{
            $this->error('数据更新失败！');
        }
    }

    // 写入用户动作
    public function saveImage() {
        import("ORG.Net.UploadFile");
        $Dao = M("User");
        $upload = new UploadFile();
        $upload->maxSize  = 3145728 ; // 设置附件上传大小
        $upload->allowExts  = array('jpg', 'png', 'jpeg');//设置上传类型限制
        $upload->savePath =  './Tpl/Public/upload/'; //设置上传路径限制
        $upload->saveRule = time();//保存文件的命名规则，这里以时间戳为文件名
        $result = $upload->upload();//保存上传文件，获取上传信息

        if( !$result ) {
            if ( $upload->getErrorMsg() != '没有选择上传文件') {//这个判断是用户不上传头像时不报错，通过。
                $this->ajaxReturn('',$upload->getErrorMsg(),0);
            }
        }
        else {
            $uploadList = $upload->getUploadFileInfo();//获取上传文件成功后的结果
            $savename = $uploadList[0]['savename'];//获取保存的文件名
            $result = $Dao ->where( array('id'=>session('user_id')) )->save( array('image' => $savename ));//更新头像对应的文件名
        }

        if($result !== false){
            $this->ajaxReturn('/user/profile','图片保存成功',1);
        }else{
            $this->ajaxReturn('','图片保存失败',0);

        }
    }

    // 更新数据
    public function update() {
        $Form = D("User");
        if ($vo = $Form->create()) {
            $list = $Form->save();
            if ($list !== false) {
                $this->success('数据更新成功！',U('user/index'));
            } else {
                $this->error("没有更新任何数据!");
            }
        } else {
            $this->error($Form->getError());
        }
    }

    // 保存新密码
    public function updatePassword() {
        $w['id']=array('eq',session('user_id'));
        $rset = M("User")->where($w)->find();

        if($rset['password'] != $_POST["oldPassword"]){
            $this->ajaxReturn('','旧密码错误！',0);

            return false;
        }
        else if(strlen($_POST["newPassword"]) < 4 || strlen($_POST["newPassword"]) > 20) {
            $this->ajaxReturn('','密码长度4-20！',0);

            return false;
        }
        else {
            $data['password'] = $_POST["newPassword"];
            $result = M("User")->where($w)->save($data);
            $this->ajaxReturn('','密码保存成功',1);
        }
    }

    // 显示特定用户的话题
    public function t($id) {
        $num = C('LOAD_TOPIC_NUM');

        $Topic = M('Topic');
        // 原生query获取所有文章信息
        $list = $Topic->query("
          SELECT u.image, u.username, tid, topic, tag, tag_num, uid, replies FROM (
            SELECT t.id as tid, t.topic as topic, t.tag as tag, t.tag_num as tag_num, t.user_id as uid, t.create_date as tcreatedate, COUNT(r.topic_id) as replies FROM thisisfive_reply r RIGHT JOIN thisisfive_topic t ON r.topic_id = t.id GROUP BY t.id) topicInfo
          LEFT JOIN thisisfive_user u on topicInfo.uid = u.id
          WHERE u.id = ".$id."
          ORDER BY tcreatedate desc
          LIMIT $num");

        $this->list =  $list;

        $this->assign('num',$num);
        $this->assign('userId',$id);


        // 查询用户信息
        $User = M("User");
        $condition['id'] = $id;
        $list = $User->where($condition)->find();
        $this->assign('udesc',$list['description']);
        $this->assign('usrname',$list['username']);
        if($list['image'] != "")
            $this->assign('image',$list['image']);
        else
            $this->assign('image',C("DEFAULT_AVATAR"));

        $this->display();
    }

    public function more($id, $userId) {
        $num = C('LOAD_TOPIC_NUM');

        $Topic = M('Topic');
        // 原生query获取所有文章信息
        $list = $Topic->query("
          SELECT u.image, u.username, tid, topic, tag, tag_num, uid, replies FROM (
            SELECT t.id as tid, t.topic as topic, t.tag as tag, t.tag_num as tag_num, t.user_id as uid, t.create_date as tcreatedate, COUNT(r.topic_id) as replies FROM thisisfive_reply r RIGHT JOIN thisisfive_topic t ON r.topic_id = t.id GROUP BY t.id) topicInfo
          LEFT JOIN thisisfive_user u on topicInfo.uid = u.id
          WHERE u.id = ".$userId."
          ORDER BY tcreatedate desc
          LIMIT $num OFFSET $id");

        $this->ajaxReturn($list);

    }
}
?>