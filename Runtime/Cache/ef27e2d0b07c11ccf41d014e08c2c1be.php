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
    <div class="account_main">
        <div class="account_header">
            <h1>
                <?php if($image != ''): ?><img src="__ROOT__/Tpl/Public/image.php?width=30&amp;height=30&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo ($image); ?>" alt="<?php echo ($username); ?>" /><?php endif; ?>
                <?php echo (session('user_a')); ?>的设置
            </h1>

            <ul class="tabs clearfix">
                <li class="active"><a href="/account/profile">帐 号</a></li>
                <li><a href="/account/password">密 码</a></li>
            </ul>
        </div>

        <div class="account_body" style="padding: 20px 30px;">
            <form id="account_avatar" action="__APP__/User/saveImage" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="item" style="height: 100px;">
                    <label>我的头像</label>
                    <?php if($image != ''): ?><img src="__ROOT__/Tpl/Public/image.php?width=100&amp;height=100&amp;cropratio=1:1&amp;image=__ROOT__/Tpl/Public/upload/<?php echo ($image); ?>" alt="<?php echo ($username); ?>" /><?php endif; ?>
                    <a href="#" class="upload_avatar">上传头像</a>
                    <div class="upload_avatar_form"  style="display: none;">
                        <p class="memo">请上传JPG、PNG格式的图片</p>
                        <input type="file" name="file" id="file" />
                        <div style="margin-top: 10px;">
                            <input type="submit" value="上传图片" />
                        </div>
                    </div>
                </div>
            </form>
            <form id="account_profile" action="__APP__/User/edit" method="post" autocomplete="off" onsubmit="return verifyOnEditingProfile()">
                <div class="item">
                    <label>昵称</label>
                    <input name="username" id="username" class="text" maxlength="15" type="text" value="<?php echo (session('user_a')); ?>"/>
                </div>
                <div class="item">
                    <label>简介</label>
                    <textarea maxlength="50" rows="3" name="description"><?php echo ($description); ?></textarea>
                </div>
                <div class="submit_area">
                    <input class="btn" type="submit" value="保存" />
                </div>
            </form>
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