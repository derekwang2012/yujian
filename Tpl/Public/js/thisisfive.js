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

// 验证用户昵称
function verifyOnEditingProfile() {
    var reg=/^[a-zA-Z0-9_\u4e00-\u9fa5]+$/ig;

    var username = $("#username");
    var usernameVal = $.trim(username.val());

    if(!reg.test(usernameVal)) {
        alert("用户只能包含汉字、数字、字母和下划线");
        return false;
    }
    else
        return true;
}

/*function deleteNotification(context, id) {
    $.post(context + '/Notification/delete/',
        { id: id },
        function(data) {
            $(".notification-count").text(data);
            $("#notification_"+id).remove();
    }).fail(function() { alert("error"); });
}*/


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

