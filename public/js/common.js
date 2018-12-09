/*Mui frame*/
var Mui = {
    centerMe : function(jel){
        var left = ($(window).width() - $(jel).outerWidth(true)) / 2 + $(window).scrollLeft();
        var top = ($(window).height() - $(jel).outerHeight(true)) / 2 + $(window).scrollTop();
        $(jel).css({'left':left});
        $(jel).css({'top':top});

        //弹出窗口在浏览器窗口大小变化时，保持纵横居中。
        $(window).resize(function () {
            var left = ($(window).width() - $(jel).outerWidth(true)) / 2 + $(window).scrollLeft();
            var top = ($(window).height() - $(jel).outerHeight(true)) / 2 + $(window).scrollTop();
            $(jel).css({'left':left});
            $(jel).css({'top':top});
        });
        //弹出窗口在浏览器纵向滚动条变化时，保持纵横居中。
        $(window).scroll(function () {
            var left = ($(window).width() - $(jel).outerWidth(true)) / 2 + $(window).scrollLeft();
            var top = ($(window).height() - $(jel).outerHeight(true)) / 2 + $(window).scrollTop();
            $(jel).css({'left':left});
            $(jel).css({'top':top});
        });
    }
};
Mui.box = {
    callback : null,
    show : function(url){
        if($('#mask_layer').length == 0 ){
            $('body').prepend('<div id="mask_layer"></div>');
        }
        if(url){
            show_tip_msg(2, 'Loading......');

            $.get(url, function(data) {
                $('#page_tips').remove();
                $('body').prepend(data);
                Mui.centerMe('#dialog');

                $('#dialog').draggable({
                    handle: '.dialog-head',
                    containment: 'window'
                });
                $('#dialog').resizable({
                    containment: "document"
                });
            });
        }else{
            $('#dialog').show();
            Mui.centerMe('#dialog');
        }
        $('body').on('keydown', function (e) {
            if(e.keyCode == 27){
                Mui.box.close();
            }
        });
    },
    close : function(){
        $('#dialog').remove();
        $('#mask_layer').remove();
    },
    close_refresh : function(jump){
        $('#dialog').remove();
        $('#mask_layer').remove();
        window.location = window.location + '#' + jump;
    }
};
Mui.form = {
    send : function(formid){
        $('#' + formid).unbind('submit').submit(function() {
            $.post($('#' + formid).attr('action'), $('#' + formid).serializeArray(), function(data) {
                Mui.form.showResult(data,formid);
            });
        });
    },
    sendAuto : function(formid){
        $('#'+formid).unbind('submit').submit(function(){
            $.post($('#'+formid).attr('action'), $('#'+formid).serializeArray(), function(data) {
                if(data.ret){
                    if(Mui.box.callback){
                        //Mui.box.setData(data.html.replace(/<script(.|\s)*?\/script(\s)*>/gi,"") );
                        Mui.box.callback();
                    }else{
                        Mui.box.setData(data.html);
                    }
                }else{
                    Mui.form.showResult(data.html,formid);
                }
            },'json');
        });
    },
    sendAuto2 : function(formid){
        var html = '<span id="page_tips" class="page_tips_process">正在处理...</span>';
        $('body').append(html);
        $('#'+formid).unbind('submit').submit(function(){
            $.post($('#'+formid).attr('action'),$('#'+formid).serializeArray(),function(data) {
                if(data.ret){
                    if (data.data != ''){
                        do_back_data(data.data);
                    }
                    var sclass = (data.type=='1')?'page_tips_success':'page_tips_fail';
                    $('#page_tips').attr('class', sclass);
                    $('#page_tips').text(data.msg);
                    setTimeout(function () {
                        if (data.type=='1'){
                            if (data.win_type == 'page'){
                                window.opener.location.reload();
                                window.close();
                            }
                            if (data.win_type == 'box'){
                                Mui.box.close();
                                $('#page_tips').remove();
                            }
                        } else {
                            $('#page_tips').remove();
                        }
                    }, data.close_time * 1000);
                } else {
                    Mui.form.showResult(data.html,formid);
                    $('#page_tips').remove();
                }
            },'json');
        });
    },
    showResult : function(ret,formid){
        if( ret != '' ){
            if( $('#meiu_notice_div').length == 0 && formid != '' ){
                $('#'+formid).before('<div id="meiu_notice_div"></div>');
                $('#meiu_notice_div').html(ret);
            }else{
                $('#meiu_notice_div').html(ret);
            }
            $('#meiu_notice_div').css({display:'block'});
        }else{
            if( $('#meiu_notice_div').length > 0 ){
                $('#meiu_notice_div').css({display:'none'});
            }
        }
    },
    send_form : function(formid) {
        show_tip_msg(2, '正在处理......');
        $.post($('#' + formid).attr('action'), $('#' + formid).serializeArray(), function(data) {
            show_tip_msg(data.status, data.msg, data.front_op, data.data);
        }, 'json');
    }
};

//页面初始化函数
$(document).ready(function(){
    //初始化只能输入金额的输入框
    $('body').on('keydown', 'input.only_price', function (e) {
        if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode == 190) || (e.keyCode == 110) || (e.keyCode == 8) || (e.keyCode == 37) || (e.keyCode == 39) || (e.keyCode == 13)){
        } else {
            return false;
        }
    });
    //初始化只能输入数字的输入框
    $('body').on('keydown', 'input.only_num', function (e) {
        if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode == 8) || (e.keyCode == 37) || (e.keyCode == 39) || (e.keyCode == 13)){
        } else {
            return false;
        }
    });

    $('body').on('change', 'select.select_page', function (e) {
        window.location = $(this).val();
    });

    $('body').on('click', 'input.btn-search', function (e) {
        var search_content = $('input[name="search_content"]').val();
        search_content = Mui.fun.trim(search_content, ' ');
        if (search_content == '') {
            alert('Search content can not be null!');
        } else {
            $('#form_search').submit();
        }
    });

    $('body').on('change', 'input[type="checkbox"].check_all', function (e) {
        $('input[type="checkbox"].check').prop('checked', $(this).prop('checked'));
    });
    $('body').on('change', 'input[type="checkbox"].check', function (e) {
        if ($('input[type="checkbox"].check:checked').length == $('input[type="checkbox"].check').length) {
            $('input[type="checkbox"].check_all').prop('checked', true);
        } else {
            $('input[type="checkbox"].check_all').prop('checked', false);
        }
    });

    $('body').on('click', '.batch_recommend', function (e) {
        event.preventDefault();
        var check = $('input[type="checkbox"].check:checked');
        if (check.length == 0) {
            show_tip_msg(0, '请选择欲推荐的内容！');
        } else {
            var arr = new Array();
            check.each(function(i) {
                arr.push($(this).attr('c_id'));
            });
            var url = '/vadmin.php/content-type/ajax_ch_recommend_batch?ids=' + arr;
            do_get_op(url);
        }
    });
});

/*批处理操作*/
function do_batch(url, msg, type, param) {
    if ($('.row_checkbox:checked').length == 0){
        alert('你什么都没有选择!');
        return ;
    }
    var sel = new Array();
    $.each($('.row_checkbox:checked'), function (k, v) {
        sel[k] = $(v).val();
    });
    if (type == 'del'){
        if (confirm('真的要' + msg + '吗？')){
            var para = {ids:sel.toString()};
            do_get_op(url + '?ids=' + sel);
        } else {
            return ;
        }
    }
    if (type == 'box'){
        Mui.box.show(url + '?ids=' + sel + param);
    }
}

/*页面切换时的函数*/
function do_get_op(url, param) {
    show_tip_msg(2, '正在处理......');
    $.post(url, param, function (data) {
        show_tip_msg(data.status, data.msg, data.front_op);
    }, 'json');
}

/*生成操作提示框*/
function show_tip_msg(status, msg, front_op) {
    var url = arguments[3]?arguments[3]:'';

    if (!front_op){
        front_op = 'no_op';
    }
    switch (status){
        case 2:
            var class_name = 'page_tips_process';
            break;
        case 1:
            var class_name = 'page_tips_success';
            break;
        case 0:
            var class_name = 'page_tips_fail';
            break;
    }

    create_tips_box(class_name, msg);
    switch (status){
        case 0:
            setTimeout(function () {
                $('#page_tips').remove();
            }, 3000);
            break;
        case 1:
            setTimeout(function () {
                $('#page_tips').remove();
            }, 3000);
            if (front_op == 'page'){
                window.opener.location.reload();
                window.close();
            }
            if (front_op == 'box'){
                Mui.box.close();
                window.location.reload();
            }
            if (front_op == 'self_page'){
                window.location.reload();
            }
            if (front_op == 'no_op'){
            }
            if (front_op == 'url'){
                window.location = url;
            }
            if (front_op == 'only_close_box'){
                Mui.box.close();
            }
            break;
        case 2:
            break;
    }
}
function create_tips_box(class_name, msg) {
    if ($('#page_tips').length != 0){
        $('#page_tips').remove();
    }
    var html = '<span id="page_tips" class="' + class_name + '">' + msg + '</span>';
    $('body').append(html);
    $('#page_tips').fadeIn('fast');
}

/*搜索框相关*/
function hide_label() {
    $('.search_box label').css('display', 'none');
}
function show_label() {
    if ($('#search_content').val() == ''){
        $('.search_box label').css('display', 'block');
        $('#search_content').css('background-color', '#F9E587');
    }
}
function check_search_form() {
    if ($('#search_content').val() == ''){
        $('#search_content').focus();
        $('#search_content').css('background-color', '#FBC6E0');
        return false;
    }
    return true;
}

/*快速编辑*/
function show_quick_edit_price(id, t, url) {
    //判断有无存在输入框
    if ($('.quick_edit_price_input').length > 0){
        return ;
    }
    $(t).removeClass('quick_edit_price');
    $(t).addClass('quick_edit_price_input');
    var price = $(t).text();
    $(t).html('<input type="text" name="edit_price" class="only_price" size="10" value="' + price + '" />');
    $(t).children('input').select();

    $(t).children('input').blur(function () {
        do_quick_edit_price($(t), id, $(t).children('input').val(), price, url);
        return ;
    });
    $(t).children('input').bind('keydown',
        function(e){
            if(e.keyCode == 13){
                do_quick_edit_price($(t), id, $(t).children('input').val(), price, url);
                return ;
            }
        }
    );
}
function do_quick_edit_price(o_span, id, price, old_price, url) {
    o_span.children('input').unbind('blur'); //防止keydown后blur
    if (confirm('确认要修改吗？')){
        if (!/^(0|([1-9]\d*))(\.\d{1,2})?$/.test(price)){
            show_tip_msg(0, '请输入正确的金额!');
            o_span.children('input').select();
            return ;
        }
        show_tip_msg(2, '正在修改, 请稍等...');
        var link_url = url + '?id=' + id + '&price=' + price;
        $.get(link_url, function (data) {
            if (data == 'success'){
                show_tip_msg(1, '修改成功!');
                o_span.removeClass('quick_edit_price_input');
                o_span.addClass('quick_edit_price');
                o_span.html(parseFloat(price).toFixed(2));
            } else {
                show_tip_msg(0, '修改失败!请稍候再试。');
                o_span.children('input').select();
            }
        });
    } else {
        o_span.removeClass('quick_edit_price_input');
        o_span.addClass('quick_edit_price');
        o_span.html(parseFloat(old_price).toFixed(2));
        return ;
    }
}
function show_quick_edit_num(id, t, url) {
    //判断有无存在输入框
    if ($('.quick_edit_num_input').length > 0){
        return ;
    }
    $(t).removeClass('quick_edit_num');
    $(t).addClass('quick_edit_num_input');
    var num = $(t).text();
    $(t).html('<input type="text" name="edit_num" class="only_num" size="10" value="' + num + '" />');
    $(t).children('input').select();

    $(t).children('input').blur(function () {
        do_quick_edit_num($(t), id, $(t).children('input').val(), num, url);
        return ;
    });
    $(t).children('input').bind('keydown',
        function(e){
            if(e.keyCode == 13){
                do_quick_edit_num($(t), id, $(t).children('input').val(), num, url);
                return ;
            }
        }
    );
}
function do_quick_edit_num(o_span, id, num, old_num, url) {
    o_span.children('input').unbind('blur'); //防止keydown后blur
    if (confirm('确认要修改吗？')){
        if (!/^[1-9][0-9]*$/.test(num)){
            show_tip_msg(0, '请输入正确的数字!');
            o_span.children('input').select();
            return ;
        }
        show_tip_msg(2, '正在修改, 请稍等...');
        //var link_url = url + '?id=' + id + '&num=' + num;
        $.post(url, {id: id, num: num}, function (data) {
            if (data == 'success'){
                show_tip_msg(1, '修改成功!');
                o_span.removeClass('quick_edit_num_input');
                o_span.addClass('quick_edit_num');
                o_span.html(parseFloat(num));
            } else {
                show_tip_msg(0, '修改失败!请稍候再试。');
                o_span.children('input').select();
            }
        });
    } else {
        o_span.removeClass('quick_edit_num_input');
        o_span.addClass('quick_edit_num');
        o_span.html(parseFloat(old_num));
        return ;
    }
}

/*程序性小函数*/
/*得到前N天或后N天的日期*/
function show_date(n) {
    var date = new Date(new Date() - 0 + n * 86400000);
    date = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
    return date;
}
/*得到前N周或后N周的日期*/
function show_week(n) {
    var date = new Date();
    var current_weekday = date.getDay();
    if (current_weekday == 0){
        current_weekday = 7;
    }
    var time_arr = new Array();
    time_arr[0] = timestamp_to_date(date.getTime() - (current_weekday - 1) * 86400000 + 7 * 86400000 * n);
    time_arr[1] = timestamp_to_date(date.getTime() + (7 - current_weekday) * 86400000 + 7 * 86400000 * n);
    return time_arr;
}
/*得到前N月或后N月的日期*/
function show_month(n) {
    var date = new Date();
    var next_month_first_day = new Date(date.getFullYear(), date.getMonth() + 1 + n, 1);
    var this_month_last_day = new Date(next_month_first_day - 0 - 86400000);
    var time_arr = new Array();
    time_arr[0] = date.getFullYear() + '-' + (date.getMonth() + 1 + n) + '-01';
    time_arr[1] = timestamp_to_date(this_month_last_day);
    return time_arr;
}
/*将JS UNIX时间转为正常日期*/
function timestamp_to_date(ts) {
    var date = new Date(ts);
    date2 = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
    return date2;
}

venus = {
    to_int: function (n) {
        return parseInt(n)?parseInt(n):0;
    },
    to_float: function (n) {
        return parseFloat(n)?parseFloat(n):0;
    },
    //s为字符串,n为小数位数
    to_price: function (s, n) {
        n = n > 0 && n <= 20 ? n : 2;
        s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
        var l = s.split(".")[0].split("").reverse(),
        r = s.split(".")[1];
        t = "";
        for(i = 0; i < l.length; i ++ ){
            t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
        }
        return t.split("").reverse().join("") + "." + r;
    },
    //s为字符串,n为小数位数
    to_price_str: function (s, n) {
        n = n > 0 && n <= 20 ? n : 2;
        s = parseFloat((s + "").replace(/[^\d\.-]/g, "")).toFixed(n) + "";
        var l = s.split(".")[0].split("").reverse(),
        r = s.split(".")[1];
        t = "";
        for(i = 0; i < l.length; i ++ ){
            t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
        }
        return '￥' + t.split("").reverse().join("") + "." + r;
    },
    //判断: 正整数(包含0, 但不为空)
    test_p_int: function (str) {
        return /^\d+$/.test(str);
    },
    //去除字符串两边的S
    trim: function (str, s) {
        return str.replace(/(^\s*)|(\s*$)/g, "");
    },
    /* 将json字符串转为json对像 */
    str_to_json: function (str) {
        var json = eval('(' + str + ')');
        return json;
    }
};