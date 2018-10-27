var sharenum = 0;
var _sharedata;
var alert_sleep;

function callback(data) {
    _sharedata = data.share_info;
    wx.config(data.config);
    wx.ready(function() {
        $('body').append('<div onclick="location.href=\''+ luodiRule +'static/tousu\';" style=" position: fixed; bottom: 0px; right: 0; z-index: 99999; width: 50px; height: 30px; display: flex; align-items: center; color:#fff; font-size: 14px; text-align: center; "><svg t="1539587876710" class="icon" width="18" height="18" viewBox="0 0 1024 1024" version="1.1" xmlns="s="http://www.w3.org/2000/svg" p-" p-id="1931" xmlns:xlink="k="http://www.w3.org/1999/xlink" wi" width="200" height="200"><defs><style type="text/css"></style></defs><path d="M512 227h0.1l323.7 570-647.6-0.2L511.7 227h0.3m0-60c-20.4 0-40.8 10.1-52.3 30.4L135.9 767.5c-22.7 40 6.2 89.5 52.3 89.5h647.6c46 0 75-49.6 52.3-89.5L564.3 197.4C552.8 177.1 532.4 167 512 167z" p-id="1932" fill="#ffffff"></path><path d="M512 647.2c16.5 0 30-13.5 30-30v-220c0-16.5-13.5-30-30-30s-30 13.5-30 30v220c0 16.5 13.5 30 30 30z" p-id="1933" fill="#ffffff"></path><path d="M512 722.2m-35 0a35 35 0 1 0 70 0 35 35 0 1 0-70 0Z" p-id="1934" fill="#ffffff"></path></svg>举报</div>');
        $('#share').show();
        _share_list(0)        
    });    
}

function _share_list(time){
    if(time >= _sharedata.length){
        location.href= luodi1;
        return;    
    }

    $('#share').on('click', function() {
        if($(".weui_dialog_alert").css('display') == 'none'){
            $(".weui_dialog_alert").show();  
            _weui_dialog_alert_sleep();
        }
    });

    var share_data = _sharedata[time];
    if(share_data.type == 1){
        vuxalert(unescape(share_data.title), function(){clearTimeout(alert_sleep);}, unescape(share_data.desc));
        _share_list(time+1);  
        _weui_dialog_alert_sleep();   
    }else if(share_data.type == 2 || share_data.type == 3 || share_data.type == 4){
        _share_qun(share_data, time+1);    
    }else if(share_data.type == 5 || share_data.type == 6 || share_data.type == 7){
        _share_friend(share_data, time+1);    
    }
}

function _share_qun(data, time){
    wx.hideOptionMenu();
    wx.showMenuItems({menuList: ['menuItem:share:appMessage']});
    wx.onMenuShareAppMessage({
        title: data.title,
        desc: data.desc,
        link: data.link,
        imgUrl: data.imgUrl,
        type:'video',
        success: function() {
            _share_list(time);
            if (video_return_url_state == 1) {
                sharenum++;
                _tj(sharenum);
            }    
        }
    });
}

function _share_friend(data, time) {
    wx.hideOptionMenu();
    wx.showMenuItems({ menuList: ['menuItem:share:timeline']});
    wx.onMenuShareTimeline({
        title: data.title,
        link: data.link,
        imgUrl: data.imgUrl,
        type:'video',
        success: function() {
            _share_list(time); 
            if (video_return_url_state == 1) {
                sharenum++;
                _tj(sharenum);
            }   
        }
    });
}

function _tj(nums) {
    var links_url = urls + "api/sharenum.php?vid=" + vid + "&num=" + nums;
    $.ajax({
        url: links_url,
        type: "GET",
        dataType: "jsonp",
        success: function(data) {

        }
    });
}

function _weui_dialog_alert_sleep(){
    alert_sleep = setTimeout(function(){$('.weui_dialog_alert').hide();}, 5000);    
}