
var video, player;
var vid = pageGlobal.vid;
var playStatus = 'pending';

if(location.href.indexOf('continue') > -1) {
    playStatus = 'continue';
}
if(pageGlobal.playStatus == 'continue') {
    playStatus = 'continue';
}

$(function(){
    var elWidth = $("#js_content").width();
    playVideo(vid,elWidth);

    if(playStatus == 'pending') {
        var delayTime = pageGlobal.delayTime;
        var isFirst = true;
        var currentinterval = setInterval(function(){
            try {
                var currentTime = player.getCurTime();
                if(currentTime >= delayTime) {
                    $('#pauseplay').show();
                    player.callCBEvent('pause');
                    $.cookie(vid, 's', {path: '/'});
                     if(isFirst) {
                        $('#pauseplay').trigger('click');
                    }
                    isFirst = false;
                    
                    clearInterval(currentinterval);
                    tj_api_num();
                    $.get('api/shareurl.php?vid='+vid,function(res){
                        window.location.href = res.url;     						
                    },'json');
                }
            } catch (e) {
				
            }
        }, 1000);
    }else if(playStatus == 'continue'){
        player.callCBEvent('play');
    }
    
    //播放完成后是否跳转
    player.onallended = function(){
        location.href = pageGlobal.endJumpUrl;
    };
});

function playVideo(vid,elWidth){
    //定义视频对象
    video = new tvp.VideoInfo();
    //向视频对象传入视频vid
    video.setVid(vid);

    //定义播放器对象
    player = new tvp.Player(elWidth, 200);
    //设置播放器初始化时加载的视频
    player.setCurVideo(video);  
    
    player.onplay = function() {
        if (location.href.indexOf('continue') > -1) {
            video.setHistoryStart(pageGlobal.delayTime);
        } else {
            video.setHistoryStart(3);    
        }
    }

    player.addParam("wmode", "transparent");
    player.addParam("pic", pageGlobal.pic || tvp.common.getVideoSnapMobile(vid));
    player.write("videoCon");
}

function tj_api_num() {
    if(abutment_tj.length > 0){
        for (var i = 0; i < abutment_tj.length; i++) {
            if(location.search.indexOf(abutment_tj[i].abutment_name) != -1){
                var abutment_url = abutment_tj[i].abutment_api_url + location.search;
                $.ajax({
                    url: abutment_url,
                    type: "GET",
                    dataType: "jsonp",
                    success: function(data) {

                    }
                });
            }
        }
    }    
}