<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>遇见</title>

    <meta content="遇见的是一个简单、温暖的小社区。" name="description"/>

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
                    <a href="__APP__/Topic/add">+ 发表话题</a>
                </li>
            </ul>
        </div>

        <div class="pro">
            <ul class="reg_link">
                <?php if(session('?user_a')): ?><li>
                        <div class="pro" style="padding: 10px 5px;">
                            <a title="1条未读提醒" href="/notification" class="notifi-num">1</a>
                        </div>
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
        <div class="topic">
            <div class="topic_header"  style=" border-bottom: 1px solid #E2E2E2;" >
                <h1 style="font-size: 18px; font-weight: blod">
                    <a class="tag tag_<?php echo ($ttagnum); ?>" href="/tag/<?php echo ($ttag); ?>"><?php echo ($ttag); ?></a>
                    <?php echo ($topic); ?>
                </h1>
            </div>
            <div style="margin-top:15px; line-height: 23px; overflow: hidden; word-wrap: break-word;">
                <?php echo ($tcontent); ?>
            </div>
        </div>
    </div>
    <!--侧边栏-->

    <div class="sidebar">

        <div class="box" style="">
            <div style="height: 100px;">
                <div style="float:left; margin-right: 10px;">
                    <a href="/member/<?php echo ($uid); ?>" style="display:block;">
                        <img width="100px" height="100px" alt="<?php echo ($username); ?>" src="__ROOT__/Tpl/Public/image.php?width=100&amp;height=100&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo ($uimage); ?>">
                    </a>
                </div>
                <div style="">
                    <div style="color:#636A86">
                        <?php echo ($username); ?>
                    </div>
                    <div style="margin-top: 10px; color: #808080; word-wrap: break-word;overflow: hidden;"><?php echo ($udesc); ?></div>
                </div>
            </div>
            <div style="border-top:1px solid #E2E2E2; margin-top: 20px;">
                <div class="topic_info">
                    <span><abbr class="timeago" title="<?php echo ($tcreatedate); ?>"></abbr></span>
                    <span><?php echo ($thits); ?>次访问</span>
                    <span><?php echo ($replyCount); ?>个回复</span>
                </div>
            </div>
        </div>

    </div>

    <div class="main radius" style="margin-top: 20px; padding-top: 10px;">
        <div class="reply_list" style="padding: 10px 16px">
            <div style="padding: 5px 0px; margin-bottom: 5px; text-align: center;">
            </div>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="comment-item" id="comment_<?php echo ($vo["id"]); ?>">
                    <a name="<?php echo ($vo["id"]); ?>" id="<?php echo ($vo["id"]); ?>"></a>
                    <div class="icon">
                        <a href="/member/<?php echo ($vo["uid"]); ?>">
                            <?php if($vo["image"] != ''): ?><img src="__ROOT__/Tpl/Public/image.php?width=48&amp;height=48&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo ($vo["image"]); ?>" alt="<?php echo ($vo["username"]); ?>">
                            <?php else: ?>
                                <img src="__ROOT__/Tpl/Public/image.php?width=48&amp;height=48&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo (C("DEFAULT_AVATAR")); ?>" alt="<?php echo ($vo["username"]); ?>"><?php endif; ?>
                        </a>
                    </div>
                    <div class="content">
                        <p style="" class="reply_user">
                            <a class="to" style="font-size: 14px;" href="/member/<?php echo ($vo["uid"]); ?>"><?php echo ($vo["username"]); ?></a>
                            <span class="comment-time floor" style="float: right;">#<?php echo ($key+1); ?></span>

                            <span class="comment-time">
                                <a data="<?php echo ($vo["username"]); ?>" title="回复<?php echo ($vo["username"]); ?>" class="go_at to" href="#" style="display: none;">回复</a>
                                <a style="display: none;" data="<?php echo ($vo["create_date"]); ?>" title="查看会话" class="talk" href="#">查看对话</a>
                                <abbr class="timeago reply_time" title="<?php echo ($vo["create_date"]); ?>" style="display: block;"></abbr>
                            </span>
                        </p>
                        <p style="margin-top: 5px; line-height: 23px;">
                            <span class="comment-text"><?php echo ($vo["content"]); ?></span>
                        </p>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>


        <div class="reply_box comment-item" style="border: 0px; padding: 10px 16px 20px;">
            <div class="icon">
                <a href="/member/<?php echo ($loginuid); ?>">
                    <img src="__ROOT__/Tpl/Public/image.php?width=48&amp;height=48&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo ($loginuimage); ?>" alt="<?php echo ($loginusername); ?>">
                </a>
            </div>
            <div class="content">
                <form method="post" action="__APP__/Topic/saveReply" autocomplete="off" id="topic_reply_add" onsubmit="return verifyOnCreatingReply()">
                    <div>
                        <textarea id="reply_content" name="content" style="width: 460px; height: 90px; overflow: hidden;"></textarea>
                        <div style="position: absolute; display: none; word-wrap: break-word; font-weight: normal; width: 460px; font-family: monospace; line-height: normal; font-size: 14px; padding: 8px;">&nbsp;</div></div>
                    <div class="comment-submit" style="margin-top: 10px;">
                        <input type="hidden" name="tid" value="<?php echo ($tid); ?>">
                        <input class="submit" type="submit" value="回复">
                        <a id="reply_box" name="reply_box"></a>
                    </div>
                </form>
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