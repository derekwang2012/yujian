<?php

class ReplyAction extends Action {

    public function save() {
        if(session('?user_a'))
        {
            $Reply = M("Reply");
            $data["topic_id"] = $_POST["tid"];
            $data["content"] = $_POST["content"];
            $data["user_id"] = session('user_id');

            if ($vo = $Reply->create()) {
                $list = $Reply->add($data);
                if ($list !== false) {
                    $this->redirect('Topic/read/id/'.$_POST["tid"]);

                } else {
                    $this->error('数据写入错误！');
                }
            } else {
                $this->error($Reply->getError());
            }
        }
        else
            $this->redirect('__APP__/User/login');
    }




}