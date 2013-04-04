<?php

class IndexAction extends Action {

    function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
    }

    public function _empty()
    {
        header("HTTP/1.0 404 Not Found");
        $this->display('Public:404');
    }

    public function index() {
        $num = C('LOAD_TOPIC_NUM');

        $Topic = M('Topic');
        // 原生query获取所有文章信息
        $list = $Topic->query("
          SELECT u.image, u.username, tid, topic, tag, tag_num, uid, replies FROM (
            SELECT t.id as tid, t.topic as topic, t.tag as tag, t.tag_num as tag_num, t.user_id as uid, t.create_date as tcreatedate, COUNT(r.topic_id) as replies FROM thisisfive_reply r RIGHT JOIN thisisfive_topic t ON r.topic_id = t.id GROUP BY t.id) topicInfo
          LEFT JOIN thisisfive_user u on topicInfo.uid = u.id
          ORDER BY tcreatedate desc
          LIMIT $num");

        $this->list =  $list;

        $this->assign('num',$num);

        if(session('?user_id')) {
            // 查询登录用户信息
            $User = M("User");
            $condition['id'] = session('user_id');
            $list = $User->where($condition)->find();
            $this->assign('udesc',$list['description']);
            $this->assign('status',$list['status']);
            if($list['image'] != "")
                $this->assign('image',$list['image']);
            else
                $this->assign('image',C("DEFAULT_AVATAR"));

            // 查询所有回复中有无提到登录用户
            $Notification = M('ReplyToCertainUsers');
            $unviewedReplies = $Notification->where('user_id = ' . session('user_id') . ' AND ' . 'viewed = 0')->count();
            $this->assign('unviewedReplies',$unviewedReplies);
        }

        $this->display();
    }

    public function more($id) {
        $num = C('LOAD_TOPIC_NUM');

        $Topic = M('Topic');
        // 原生query获取所有文章信息
        $list = $Topic->query("
          SELECT u.image, u.username, tid, topic, tag, tag_num, uid, replies FROM (
            SELECT t.id as tid, t.topic as topic, t.tag as tag, t.tag_num as tag_num, t.user_id as uid, t.create_date as tcreatedate, COUNT(r.topic_id) as replies FROM thisisfive_reply r RIGHT JOIN thisisfive_topic t ON r.topic_id = t.id GROUP BY t.id) topicInfo
          LEFT JOIN thisisfive_user u on topicInfo.uid = u.id
          ORDER BY tcreatedate desc
          LIMIT $num OFFSET $id");

        $this->ajaxReturn($list);

    }
}