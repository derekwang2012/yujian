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
    <div class="reg_form">

        <form action="__APP__/User/dologin" method="POST">
            <div class="reg_title">登录</div>

            <div class="">邮箱</div>

            <div>
                <input tabindex="1" type="text" class="title" name="email" value="" id="email" />
            </div>

            <div>密码</div>

            <div>
                <input tabindex="2" type="password" class="title" name="password" value="" />
            </div>

            <div class="reg_input">
                <input tabindex="4" type="submit" class="reg_bottom" value="登录"/>
            </div>
        </form>
    </div>

    <div class="reg_side">
        <div>还没有帐号?</div>
        <a href="__APP__/User/reg">马上注册</a>
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