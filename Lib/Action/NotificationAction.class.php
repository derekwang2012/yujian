<?php

class NotificationAction extends Action {


    public function index() {

        if(session('?user_id')) {
            // 查询登录用户信息
            $User = M("User");
            $condition['id'] = session('user_id');
            $list = $User->where($condition)->find();
            $this->assign('udesc',$list['description']);
            if($list['image'] != "")
                $this->assign('image',$list['image']);
            else
                $this->assign('image',C("DEFAULT_AVATAR"));

            // 查询所有回复中有无提到登录用户
            $Notification = M('ReplyToCertainUsers');
            $unviewedReplies = $Notification->where('user_id = ' . session('user_id') . ' AND ' . 'viewed = 0')->count();
            $this->assign('unviewedReplies',$unviewedReplies);

            // 查询所有文章和谁@了我当viewed=false
            $Topic = M('Topic');
            // 原生query
            $notifications = $Topic->query("SELECT rcu.id as rcuid, t.topic as topic, t.id as tid, u.username as usernmae, u.id as uid, u.image as uimage, r.id as rid
                FROM thisisfive_reply_to_certain_users rcu, thisisfive_topic t, thisisfive_user u, thisisfive_reply r
                WHERE rcu.topic_id = t.id AND rcu.reply_id = r.id AND r.user_id = u.id AND rcu.viewed = 0 AND rcu.user_id = " . session('user_id'));

            $this->notifications =  $notifications;
        }

        $this->display();
    }

    public function delete($id) {
        $Dao = M("ReplyToCertainUsers");

        // 需要更新的数据
        $data['id'] = $id;
        $data['viewed'] = 1;
        $result = $Dao->save($data);

        $this->redirect('/notification');
    }

    public function deleteAll() {
        $Dao = M("ReplyToCertainUsers");

        $condition['user_id'] = session('user_id');
        $data['viewed'] = 1;
        $result = $Dao->where($condition)->save($data);

        $this->redirect('/notification');

    }
}