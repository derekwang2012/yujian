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
        <div class="home-header radius_top">
            <div style="padding: 5px; color: #808080;">
                这是<strong>遇见</strong>，一个是简单，温暖de社区。
            </div>
        </div>

        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="stream-item" id="topic_<?php echo ($vo["tid"]); ?>" tid="<?php echo ($vo["tid"]); ?>">
                <div  class="mod status-item ">
                    <div class="hd">
                        <a class="icon" title="" href="/member/<?php echo ($vo["uid"]); ?>">
                            <img alt="<?php echo ($vo["username"]); ?>" title="<?php echo ($vo["username"]); ?>" src="__ROOT__/Tpl/Public/image.php?width=22&amp;height=22&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo ($vo["image"]); ?>" />
                        </a>
                    </div>
                    <div class="text">
                        <span><a class="tag tag_<?php echo ($vo["tag_num"]); ?>" href="/tag/<?php echo ($vo["tag"]); ?>"><?php echo ($vo["tag"]); ?></a><a class="web_link" href="__APP__/Topic/read/id/<?php echo ($vo["tid"]); ?>"><?php echo ($vo["topic"]); ?></a></span>
                    <span onselectstart="return false;" title="快捷回复" class="icon-comments">
                        <span class="comments-count"><?php echo ($vo["replies"]); ?></span>
                    </span>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>



        <div style="padding: 15px 8px; text-align: center;">
            <a style="text-decoration:none; color: #808080;" class="page_item" href="/?start=64">更多话题</a>
        </div>
    </div>

    <!--侧边栏-->
    <div class="comment" style=" display: none;">
        <div class="pane-toolbar">
            <a id="comment_close" class="close" href="">×</a>
        </div>
        <div class="comments-items">
            <div class="loading" style="display:none; text-align: center; padding: 20px 0px;">
                <!--<div><img src="__ROOT__/img/loading.gif" /></div>-->
                <div style="color: #808080;">加载中</div>
            </div>
            <div></div>
            <div id="comments_list">
            </div>
        </div>
    </div>
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

        <div class="box" style="margin-top: 20px;">
            <div>

                <a href="/about" style="color: #808080; margin-right: 10px;">关于</a>

            </div>
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