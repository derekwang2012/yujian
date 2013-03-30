<?php

class TopicAction extends Action {

    public function read($id) {
        // 访问数自动加1
        $Dao = M("Topic");
        $result = $Dao->where('id = ' . $id)->setInc('hits',1);

        // 得到指定标题的信息
        $Topic = M('Topic');
        $result = $Topic
            ->table('thisisfive_topic t, thisisfive_user u')
            ->where('t.id = ' . $id . ' AND t.user_id = u.id')
            ->field('t.topic as topic, t.content as content, t.tag as tag, t.tag_num as tag_num, t.create_date as create_date, t.hits as hits, t.likes as likes, u.id as uid, u.username as username, u.image as image, u.description as description')
            ->order('t.create_date desc' )
            ->select();

        $this->assign('tid',$id);
        $this->assign('topic',$result[0]['topic']);
        $this->assign('tcontent',$result[0]['content']);
        $this->assign('ttag',$result[0]['tag']);
        $this->assign('ttagnum',$result[0]['tag_num']);
        $this->assign('tcreatedate',$result[0]['create_date']);
        $this->assign('thits',$result[0]['hits']);
        $this->assign('tlike',$result[0]['likes']);
        $this->assign('uid',$result[0]['uid']);
        $this->assign('username',$result[0]['username']);
        $this->assign('udesc',$result[0]['description']);

        if($result[0]['image'] != "")
            $this->assign('uimage',$result[0]['image']);
        else
            $this->assign('uimage',C("DEFAULT_AVATAR"));


        $this->assign('loginuid',session('user_id'));
        $this->assign('loginusername',session('user_a'));

        // 得到登录用户的信息
        $User = M("User");
        $condition['id'] = session('user_id');
        $list = $User->where($condition)->find();
        $this->assign('loginudesc',$list['description']);
        if($list['image'] != "")
            $this->assign('loginuimage',$list['image']);
        else
            $this->assign('loginuimage',C("DEFAULT_AVATAR"));

        // 得到关于这篇标题的所有回复
        $Reply = M('Reply');

        $list = $Reply
            ->table('thisisfive_reply r, thisisfive_topic t, thisisfive_user u')
            ->where('r.topic_id = t.id AND t.id = ' . $id . ' AND r.user_id = u.id')
            ->field('r.id as id, r.content as content, r.create_date as create_date, u.id as uid, u.image as image, u.username as username')
            ->order('r.create_date asc' )
            ->select();

        $this->list =  $list;

        // 得到这篇文章的回复总数
        $replyCount = $Reply->where('topic_id = ' . $id)->count();
        $this->assign('replyCount',$replyCount);

        if(session('?user_id')) {

            // 查询所有回复中有无提到登录用户
            $Notification = M('ReplyToCertainUsers');
            $unviewedReplies = $Notification->where('user_id = ' . session('user_id') . ' AND ' . 'viewed = 0')->count();
            $this->assign('unviewedReplies',$unviewedReplies);
        }

        $this->display();
    }

    public function add() {
        if(session('?user_a'))
        {
            $User = M("User");

            // 构造查询条件
            $condition['id'] = session('user_id');
            // 查询数据
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

            $this->display();
        }
        else
            $this->redirect('__APP__/user/login');
    }

    public function save() {
        if(session('?user_a'))
        {
            $Form = M("Topic");
            $data["topic"] = $_POST["topic"];
            $data["content"] = makelink($_POST["content"]);
            $data["tag"] = $_POST["tag_name"];
            $data["tag_num"] = mt_rand(0,14);
            $data["user_id"] = session('user_id');

            /*$data['content'] = preg_replace_callback('#(?:https?://\S+)|(?:www.\S+)|(?:\S+\.\S+)#', function($arr)
            {
                if(strpos($arr[0], 'http://') !== 0)
                {
                    $arr[0] = 'http://' . $arr[0];
                }
                $url = parse_url($arr[0]);

                // images
                if(preg_match('#\.(png|jpg|gif)$#', $url['path']))
                {
                    return '<img src="'. $arr[0] . '" />';
                }
                // youtube
                if(in_array($url['host'], array('www.youtube.com', 'youtube.com'))
                    && $url['path'] == '/watch'
                    && isset($url['query']))
                {
                    parse_str($url['query'], $query);
                    return sprintf('<iframe class="embedded-video" width="550" height="400" src="http://www.youtube.com/embed/%s" allowfullscreen></iframe>', $query['v']);
                }
                //links
                return sprintf('<a href="%1$s">%1$s</a>', $arr[0]);
            }, $data['content']);*/

            if ($vo = $Form->create()) {
                $list = $Form->add($data);
                if ($list !== false) {
                    $this->ajaxReturn($list,'数据写入成功！',1);
                } else {
                    $this->ajaxReturn('','数据写入错误！',0);
                }
            } else {
                $this->ajaxReturn('',$Form->getError(),0);
            }
        }
        else
            $this->redirect('__APP__/user/login');
    }

    public function saveReply() {
        if(session('?user_a'))
        {
            $Reply = M("Reply");
            $data["topic_id"] = $_POST["tid"];
            $data["content"] = $_POST["content"];
            $data["user_id"] = session('user_id');

            if ($vo = $Reply->create()) {
                $list = $Reply->add($data);
                if ($list !== false) {

                    // -----------------
                    $parts = explode('@', $data["content"]);
                    if(strpos($data["content"], '@') !== false) {
                        $array_usernames = array();
                        foreach ($parts as $value) {
                            $trimmedValue = trim($value);
                            if($trimmedValue != "") {
                                if(!strpos($trimmedValue, " ")) {
                                    $array_usernames[] = $trimmedValue;
                                }
                                else {
                                    $array_usernames[] = substr($trimmedValue, 0 , strpos($trimmedValue, " "));
                                }
                            }
                        }

                        $User = M("User");

                        foreach(array_unique($array_usernames, SORT_REGULAR) as $value) {

                            $ReplyToCertainUsers = M("ReplyToCertainUsers");

                            $data['user_id'] = $User->where('username="'.$value.'"')->getField('id');
                            $data['reply_id'] = $list;
                            $data["topic_id"] = $_POST["tid"];

                            $ReplyToCertainUsers->add($data);
                        }
                    }
                    else {
                        $Topic = M("Topic");
                        $ReplyToCertainUsers = M("ReplyToCertainUsers");

                        $data['user_id'] = $Topic->where('id="'.$_POST["tid"].'"')->getField('user_id');
                        $data['reply_id'] = $list;
                        $data["topic_id"] = $_POST["tid"];

                        $ReplyToCertainUsers->add($data);
                    }

                    // -----------------
                    $this->ajaxReturn($_POST["tid"],'回复成功！',1);
                    /*$this->redirect('/topic/read/id/'.$_POST["tid"]);*/

                } else {
                    $this->ajaxReturn('','数据写入错误！',0);
                }
            } else {
                $this->ajaxReturn('',$Reply->getError(),0);
            }
        }
        else
            $this->redirect('__APP__/user/login');
    }

    public function like($id) {
        $ip = get_client_ip();
        $Dao = M('Topic');
        $TopicIp = M("TopicIp");

        $sameIpCountOnTopic = $TopicIp->where('topic_id = ' . $id . ' AND ip = "' . $ip . '"')->count();

        if($sameIpCountOnTopic == 0) {
            $result = $Dao->where('id = ' . $id)->setInc('likes');
            $data['topic_id'] = $id;
            $data['ip'] = $ip;
            $TopicIp->add($data);

            $likes = $Dao->where('id = ' . $id)->getField('likes');

            $this->ajaxReturn($likes, '', 1);
        }
        else {
            $this->ajaxReturn('你已经喜欢过了', '', 0);
        }
    }
}