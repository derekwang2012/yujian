<?php

class UserModel extends Model {

    // 自动验证设置
    protected $_validate = array(

        array('email','email','邮箱格式不符合要求。'),
        array('username', 'require', '用户名必须'),
        array('username', '', '呢称已经存在', 0, 'unique', self::MODEL_INSERT),
        array('password','4,20','密码长度不符！',3,'length'), // 验证标题长度
        array('email', '', '邮箱已经存在', 0, 'unique', self::MODEL_INSERT),
        array('repassword','password','确认密码不正确。',0,'confirm')
    );
    // 自动填充设置
   /* protected $_auto = array(
        array('create_date', 'time', self::MODEL_INSERT, 'function'),
    );*/

}

?>