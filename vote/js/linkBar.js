/**
 * Created by 1MHz on 14-4-21.
 */
$(function() {
    $('.logo').tipsy({gravity: 's', title: 'data-title', html: true, fade: true});

    $('.logo').mouseover(function() {
        var me = $(this);
        var bgColor = me.attr('data-color');
        $('#linkBar').css('background-color', bgColor);
        me.css("background-color", '#fff');

        me.stop();
        me.css("opacity", 1);
        $('.logo').not(me).stop().animate({opacity: 0.1}, 400);

    });

    $('.logo').mouseout(function() {
        var me = $(this);

        $('#linkBar').css('background-color', 'RGB(244, 244, 244)');
        me.css('background-color', '');

        $('.logo').stop().animate({opacity: 1}, 800);
    });
});