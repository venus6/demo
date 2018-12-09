;(function($) {
    $.fn.venusSlider = function(options) {
        var defaults = {
            pic_width: $(window).width(),
            pic_height: '157px',
            pause_time: 2000,
            anim_speed: 300
        };

        var options = $.extend(defaults, options);

        this.each(function () {
            //set style
            t = $(this);
            var e_div_w = options.pic_width;
            t.css('width', e_div_w);
            t.css('height', options.pic_height);
            t.find('img').css({
                'height': options.pic_height,
                'width': e_div_w
            });

            //define var
            var e_div = t;
            var e_ul = e_div.children('ul');
            var e_ul_li = e_div.children('ul').children('li');
            var e_ol = e_div.children('ol');
            var e_ol_li = e_div.children('ol').children('li');
            var e_ul_li_w = e_div_w;
            var e_li_len = e_ol_li.length;

            t.children('ul').css('width', e_ul_li_w * e_li_len + 'px');

            /*自动运行*/
            var time_id = null;
            time_id = setInterval(fun_slide, options.pause_time);

            /*适用于PC*/
            e_ol_li.on('mouseover', function(event) {
                event.preventDefault();

                var index = $(this).index();
                $(this).addClass('current').siblings().removeClass('current');
                e_ul.animate({
                    'left': '-' + e_ul_li_w * index + 'px'
                }, options.anim_speed);
            });
            e_ul_li.hover(function() {
                clearInterval(time_id);
            }, function() {
                time_id = setInterval(fun_slide, options.pause_time);
            });
            e_ol_li.on('mouseover', function(event) {
                clearInterval(time_id);
            }).on('mouseout', function(event) {
                time_id = setInterval(fun_slide, options.pause_time);
            });

            /*适用于触摸设备*/
            /*e_ul_li.on('touchmove', function(event) {
                event.preventDefault();
                alert(event.touches[0])
            });*/

            function fun_slide() {
                var el_ol_li_cur = e_ol.children('li.current');
                var index = el_ol_li_cur.index();
                var index_next = index + 1; //数字计数器
                var index_next_2 = index_next;    //图片运动距离的计数器

                if (index_next == e_li_len) {
                    index_next = 0;

                    e_ul_li.eq(0).css({
                        'position': 'relative',
                        'left': e_ul.width()
                    });
                }

                e_ol_li.eq(index_next).addClass('current').siblings().removeClass('current');
                e_ul.animate({
                    'left': '-' + e_ul_li_w * index_next_2 + 'px'
                }, options.anim_speed, function () {
                    if (index_next == 0) {
                        e_ul_li.eq(0).css({
                            'position': 'static'
                        });
                        e_ul.css('left', 0);
                    }
                });
            }
        });

        return this;    //返回对像，用于链式操作
    };
})(jQuery);