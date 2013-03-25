<?php

class IndexAction extends Action {

    function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
    }

    public function index() {
        $Topic = M('Topic');
        // 原生query获取所有文章信息
        $list = $Topic->query("
          SELECT u.image, u.username, tid, topic, tag, tag_num, uid, replies FROM (
            SELECT t.id as tid, t.topic as topic, t.tag as tag, t.tag_num as tag_num, t.user_id as uid, t.create_date as tcreatedate, COUNT(r.topic_id) as replies FROM thisisfive_reply r RIGHT JOIN thisisfive_topic t ON r.topic_id = t.id GROUP BY t.id) topicInfo
          LEFT JOIN thisisfive_user u on topicInfo.uid = u.id
          ORDER BY tcreatedate desc");


        /*$list = $Topic
            ->table('thisisfive_topic t, thisisfive_user u, thisisfive_reply r')
            ->where('t.user_id = u.id AND t.id = r.topic_id')
            ->field('t.id as id, t.topic as topic, t.tag as tag, t.tag_num as tag_num, u.id as uid, u.username as username, u.image as image, count(r.topic_id) as replies')
            ->group('t.id')
            ->order('t.create_date desc' )
            ->select();*/

        $this->list =  $list;

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
        

        $this->display();
    }




}