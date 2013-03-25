<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>五号社区</title>

    <meta content="五号社区的是一个简单、温暖的小社区。" name="description"/>

    <link href="__ROOT__/Tpl/Public/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<a id="top"></a>
<div class="header_container">
    <div class="container">
        <div class="logo"></div>
        <div class="nav">
            <ul>
                <li>
                    <a href="__APP__/Index" style="color: #fff;">首页</a>
                </li>
                <li>
                    <a href="__APP__/Topic/add">发表话题</a>
                </li>
            </ul>
        </div>

        <div class="pro">
            <ul class="reg_link">
                <?php if(session('?user_a')): ?><li>
                        <a href="__APP__/User/profile"><?php echo (session('user_a')); ?></a>
                    </li>
                    <li>
                        <a href="__APP__/User/profile">设置</a>
                    </li>
                    <li>
                        <a href="__APP__/User/logout">注销</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="__APP__/User/reg">注册</a>
                    </li>
                    <li>
                        <a href="__APP__/User/login">登录</a>
                    </li><?php endif; ?>

            </ul>
        </div>
    </div>
</div>

<div class="container">
    <!--主体-->
    <div class="main radius">

        <div style="padding: 5px 5px 15px 5px;">

            <div style="padding: 10px 0px 20px 10px; color: #808080;">
                创建话题
            </div>
            <div class="add" >
                <form method="post" action="__APP__/Topic/save" id="topic_add" autocomplete="off" onsubmit="return verifyOnCreatingTopic()">
                    <div class="item">
                        <input name="topic" id="topic" class="text" maxlength="30" type="text" value=""/><span style="color: #808080; margin-left: 5px; font-size: 12px;">标题不少于5个字</span>
                    </div>
                    <div class="item">
                        <textarea id="topic_content" name="content" style="width: 520px; height: 320px"></textarea>
                    </div>
                    <div class="item">
                        <a href="#" id="add_tag_link" style="color: #808080;">添加标签</a>
                        <div style="display:none;" id="tag_input">
                            <input name="tag_name" class="text" maxlength="2" type="text" value="" style="width:60px;">
                            <span style="margin-left: 10px; font-size: 12px;">标签为两个汉字（如电影、工作等，清晰、合理的标签可以让话题更有价值。）</span>
                        </div>
                    </div>
                    <div>
                        <input class="reg_bottom" type="submit" value="创建" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--侧边栏-->

    <div class="sidebar">

        <div class="box" style="">
            <div>
                <?php if(session('?user_a')): ?><div style="float:left; margin-right: 10px;">
                        <a href="/member/<?php echo (session('user_id')); ?>" style="display:block;">
                            <img width="100px" height="100px" alt="<?php echo (session('user_a')); ?>" src="__ROOT__/Tpl/Public/image.php?width=100&amp;height=100&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo ($image); ?>">
                        </a>
                    </div>
                    <div>
                        <div style="color:#636A86">
                            <?php echo (session('user_a')); ?>
                            <span class="sidebar_user_online"><span class="sidebar_user_online_text">•</span><span class="online_text">在线</span></span>
                        </div>
                        <div style="margin-top: 10px; color: #808080; word-wrap: break-word;overflow: hidden;"><?php echo ($udesc); ?></div>

                    </div>
                    <?php else: ?>
                    欢迎来到 <b style="color: #4B8DC5;">五号社区</b>
                    <br>这里是一个简单、温暖的小社区。<?php endif; ?>

            </div>
            <div style="clear: both;"></div>
        </div>


    </div>
</div>

<div class="container" style="clear: both; text-align: center; color: #ffffff; padding: 35px 0px;">
    &copy; 2012-2013
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__ROOT__/Tpl/Public/js/jquery.timeago.js"></script>
<script type="text/javascript" src="__ROOT__/Tpl/Public/js/thisisfive.js"></script>



</body>
</html>