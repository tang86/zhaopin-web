(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
})(jQuery);
$(function(){
    $("#btn-share").click(function() {
        var userId = window.location.pathname.slice(12);
        var orderNumber = $.getUrlParam('order_number');
        wx.miniProgram.navigateTo({url:'/pages/report/share?user_id='+userId+'&order_number='+orderNumber});
    });
    $("#btn-home").click(function() {
        wx.miniProgram.switchTab({url:'/pages/home/home'});
    });
    $(".nav a").click(function() {
        activity($(this));
    })
    $(".nav a").on("touchmove", function(event) {
        event.stopPropagation();
    });
    $(".switcher").click(function(){
        show();
    })

    function show() {
        $('.nav').show()
        $('.switcher').hide()
        var topnow = $(document).scrollTop();
        var active = null;
        $(".nav a").each(function(index, item) {
            var id = $(item).attr("href");
            var topset = $(id).offset();
            if(typeof topset != 'undefined') {
                var diff = topnow - topset.top;
                if(diff > 0) {
                    active = $(item);
                }
            }
        })
        if(active != null) {
           activity(active); 
        }
    }

    function activity(obj) {
        obj.siblings().removeClass("active");
        obj.addClass("active");
    }

    function hide() {
        $('.switcher').show()
        $('.nav').hide()
    }
    $("body").on("touchmove", function() {
        hide();
    })
    show()
})

