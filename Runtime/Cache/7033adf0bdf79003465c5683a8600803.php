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
    <div class="reg_form">
        <form action="__APP__/User/save" method="POST" autocomplete="off">
            <div class="reg_title">注册</div>
            <div class="reg_memo">欢迎来到五号社区！这里是一个简单、温暖的小社区。</div>

            <div class="reg_item">邮箱</div>

            <div>
                <input tabindex="1" type="text" class="title" name="email" maxlength="40" value="" id="email" />
            </div>

            <div class="reg_item">密码</div>

            <div>
                <input tabindex="2" type="password" class="title" name="password" maxlength="20" value="" />
            </div>

            <div class="reg_item">确认密码</div>

            <div>
                <input tabindex="3" type="password" class="title" name="repassword" maxlength="20" value="" />
            </div>

            <div class="reg_item">昵称</div>

            <div>
                <input tabindex="4" type="text" class="title" name="username" maxlength="20" value="" />
            </div>

            <div class="reg_input">
                <input tabindex="5" type="submit" class="reg_bottom" value="创建用户"/>
            </div>
        </form>
    </div>
    <div class="reg_side">
        <div>已经有帐号了?</div>
        <a href="__URL__/login">马上登录</a>
    </div>

</div>

<div class="container" style="clear: both; text-align: center; color: #808080; padding: 35px 0px;">
    &copy; 2012-2013     </div>
<div class="gotoTop" title="返回顶部" style="display: none;"></div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__ROOT__/Tpl/Public/js/jquery.timeago.js"></script>
<script type="text/javascript" src="__ROOT__/Tpl/Public/js/index.js"></script>



</body>
</html>