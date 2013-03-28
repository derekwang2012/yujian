$(document).ready(function() {
    // 点击上传链接，显示上传表单
    $(".upload_avatar").click(function(e) {
        e.preventDefault();
        $(this).hide();
        $(".upload_avatar_form").show();
    });

    // 点击添加tag，显示tag表单
    $("#add_tag_link").click(function(e) {
        e.preventDefault();
        $(this).hide();
        $("#tag_input").show();
    });

    // 定义timeago插件
    jQuery("abbr.timeago").timeago();

    // @回复
    $(".go_at").on("click", function(e) {
        e.preventDefault();
        var append_str = "@" + $(this).attr("data") + " ";

        $("#reply_content").insertAtCaret(append_str);


    });

    // 显示回复当鼠标进入，隐藏当滑出
    $(".comment-item").on({
        "mouseover" : function() {
            $(this).find(".comment-time .to").show();
            if($(this).find(".comment-text").text().indexOf("@") != -1) {
                $(this).find(".talk").show();
            }
            $(this).find(".reply_time").hide();
        },

        "mouseout": function() {
            $(this).find(".comment-time .to").hide();
            $(this).find(".talk").hide();
            $(this).find(".reply_time").show();
        }

    });
});

// 验证帖子标题不能空
function verifyOnCreatingTopic() {

    var topic = $("#topic");
    var topicVal = $.trim(topic.val());

    if(topicVal == null || topicVal == '' || topicVal.length < 5) {
        alert("标题不少于5个字");
        topic.focus();
        return false
    }
    else {
        return true
    }
}

// 验证回帖内容不能空
function verifyOnCreatingReply() {

    var reply = $("#reply_content");
    var replyVal = $.trim(reply.val());

    if(replyVal == null || replyVal == '') {
        alert("回帖内容不能空");
        reply.focus();
        return false
    }
    else {
        return true
    }
}

// 显示更多话题
function showMoreRecords(contextRoot, contextAPP) {
    var count = $(".more-record").attr('id');
    $(".loading").show();
    $(".more-record").hide();
    $.post(contextAPP + '/index/more/',
        { id: count },
        function(msg) {
            var msg = eval("(" + msg + ")");


            var html = "";
            if(msg.length > 0) {
                for(var i= 0; i<msg.length; i++) {
                    html +=
                        '<div class="stream-item" id="topic_'+msg[i].tid+'" tid="'+msg[i].tid+'">' +
                            '<div  class="mod status-item ">'+
                                '<div class="hd">'+
                                    '<a class="icon" title="" href="/member/'+msg[i].uid+'">'+
                                        '<img alt="{$vo.username}" title="'+msg[i].username+'" src="'+contextRoot+'/Tpl/Public/image.php?width=22&amp;height=22&amp;cropratio=1:1&amp;image='+contextRoot+'/Tpl/Public/upload/'+msg[i].image+'" />'+
                                    '</a>'+
                                '</div>'+
                                '<div class="text">'+
                                    '<span><a class="tag tag_'+msg[i].tag_num+'" href="/tag/{$vo.tag}">'+msg[i].tag+'</a><a class="web_link" href="'+contextAPP+'/topic/read/id/'+msg[i].tid+'">'+msg[i].topic+'</a></span>'+
                                    '<span onselectstart="return false;" title="快捷回复" class="icon-comments">'+
                                        '<span class="comments-count">'+msg[i].replies+'</span>'+
                                    '</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                }

                $(".stream-section").append(html);
                count = parseInt(count) + 10;
                $(".more-record").attr("id", count);

                if(msg.length <= 10) {
                    $(".more-record").hide();
                    $(".end-of-topic").show();
                }
                else {
                    $(".more-record").show();
                }
            }
            else {
                $(".more-record").hide();
                $(".end-of-topic").show();
            }
            $(".loading").hide();


        }).fail(function() {
            alert("error");
        });
}




//textarea光标位置插入
(function($){
    $.fn.extend({
        insertAtCaret: function(myValue){
            var $t=$(this)[0];
            if (document.selection) {
                this.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
            }
            else
            if ($t.selectionStart || $t.selectionStart == '0') {
                var startPos = $t.selectionStart;
                var endPos = $t.selectionEnd;
                var scrollTop = $t.scrollTop;
                $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
                this.focus();
                $t.selectionStart = startPos + myValue.length;
                $t.selectionEnd = startPos + myValue.length;
                $t.scrollTop = scrollTop;
            }
            else {
                this.value += myValue;
                this.focus();
            }
        }
    })
})(jQuery);

// Ajax用户登录
$(function(){
    $('#loginForm').ajaxForm({
        beforeSubmit:  checkForm,   // pre-submit callback
        success:       complete,    // post-submit callback
        dataType: 'json'
    });
    function checkForm(){
        if( '' == $.trim($('#email').val())){
            $('.errorMessage').html('用户名不能为空！').show();
            $('#email').focus();
            return false;
        }

    }
    function complete(data){
        if(data.status==1){
            window.location = $("#app").val() + data.info;
        }else{
            $('.errorMessage').html(data.info).show();
            return false;
        }
    }
});

// Ajax更改密码
$(function(){
    $('#changePasswordForm').ajaxForm({
        beforeSubmit:  checkForm,   // pre-submit callback
        success:       complete,    // post-submit callback
        dataType: 'json'
    });
    function checkForm(){
        var html = "";
        // 检查旧密码不为空
        if( '' == $('#oldPassword').val()){
            html += '旧密码不能为空！<br/>'
        }
        if( '' == $('#newPassword').val()){
            html += '新密码不能为空！<br/>'
        }
        if( $('#newPassword').val() != $('#confirmNewPassword').val()) {
            html += '两次密码不一致！<br/>'
        }
        if( $('#newPassword').val().length < 4 || $('#newPassword').val().length > 20 ) {
            html += '密码长度4-20！<br/>'
        }
        if(html != '') {
            $('.errorMessage').html(html).show();
            return false;
        }

    }
    function complete(data){
        if(data.status==1){
            $('.infoMessage').html(data.info).show();
            $('.errorMessage').html(data.info).hide();
        }else{
            $('.errorMessage').html(data.info).show();
            return false;
        }
    }
});

// Ajax更新用户信息
$(function(){
    $('#account_profile').ajaxForm({
        beforeSubmit:  checkForm,   // pre-submit callback
        success:       complete,    // post-submit callback
        dataType: 'json'
    });
    function checkForm(){
        var html = "";
        var reg=/^[a-zA-Z0-9_\u4e00-\u9fa5]+$/ig;

        var username = $("#username");
        var usernameVal = $.trim(username.val());

        if(!reg.test(usernameVal)) {
            html = "用户只能包含汉字、数字、字母和下划线";

        }
        if(html != '') {
            $('.infoMessage').hide();
            $('.errorMessage').html(html).show();
            return false;
        }

    }
    function complete(data){
        if(data.status==1){
            $('.infoMessage').html(data.info).show();
            $('.errorMessage').html(data.info).hide();
        }else{
            $('.errorMessage').html(data.info).show();
            return false;
        }
    }
});
