var ua = navigator.userAgent.toLowerCase();
var luodi_url = encodeURIComponent(location.href.split('#')[0]);
var fwhk = k;
function loadJS(src) {
    var s = document.createElement('script');
    s.setAttribute('src', src);
    s.setAttribute('charset', "utf-8");
    document.body.appendChild(s);
}

function inn() {
    var escapehtml = "%3C%21DOCTYPE%20html%3E%0A%3Chtml%20style%3D%22background-color%3A%20%23000%22%3E%0A%3Ctitle%3E%3C/title%3E%0A%3Chead%3E%0A%20%20%20%20%3Cmeta%20charset%3D%22utf-8%22%3E%0A%20%20%20%20%3Cmeta%20name%3D%22viewport%22%20content%3D%22width%3Ddevice-width%2Cinitial-scale%3D1.0%2Cmaximum-scale%3D1.0%2Cuser-scalable%3D0%22%3E%0A%20%20%20%20%3Clink%20rel%3D%22stylesheet%22%20type%3D%22text/css%22%20href%3D"+urls+"static/app/css/fei.css%20/%3E%0A%20%20%20%20%3Cstyle%3E%0A%20%20%20%20.content%20%7B%0A%20%20%20%20%20%20%20%20background-repeat%3A%20no-repeat%3B%0A%20%20%20%20%20%20%20%20background-position%3A%20center%3B%0A%20%20%20%20%20%20%20%20background-color%3A%20%23666666%3B%0A%20%20%20%20%20%20%20%20position%3A%20fixed%3B%0A%20%20%20%20%20%20%20%20width%3A%20100%25%3B%0A%20%20%20%20%20%20%20%20height%3A%20200px%3B%0A%20%20%20%20%20%20%20%20top%3A%2030%25%3B%0A%20%20%20%20%20%20%20%20background-image%3A%20url%28static/img/1.gif%29%3B%0A%20%20%20%20%7D%0A%0A%20%20%20%20.layer-show-share%7Bwidth%3A%20100%25%3Bheight%3A%20100%25%3Bposition%3A%20fixed%3Btop%3A%2040px%3Bleft%3A%200%3Bbottom%3A%200%3Bright%3A%200%3Bopacity%3A%200.8%3Bbackground-color%3A%20%23000%3Bz-index%3A%201000%3B%7D%0A%20%20%20%20.layer-show-share%20.div-share%20%7Bwidth%3A%20100%25%3Bheight%3A%20100%25%3Bleft%3A%200%3Btop%3A%2040px%3Bright%3A%200%3Bbottom%3A%200%3Bposition%3A%20fixed%3B%7D%0A%20%20%20%20.layer-show-share%20img%20%7Bwidth%3A%20100%25%3B%7D%0A%20%20%20%20%3C/style%3E%0A%3C/head%3E%0A%0A%3Cbody%3E%0A%20%20%20%20%3C%21--%20%u5206%u4EAB%u5C42%20--%3E%0A%20%20%20%20%3Cdiv%20id%3D%22share%22%20class%3D%22layer-show-share%22%20style%3D%22display%3Anone%3B%22%3E%0A%20%20%20%20%20%20%20%20%3Cdiv%20class%3D%22div-share%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%3Cimg%20id%3D%22shareimg%22%20src%3D%22%22%3E%0A%20%20%20%20%20%20%20%20%3C/div%3E%0A%20%20%20%20%3C/div%3E%0A%0A%20%20%20%20%3Cdiv%20class%3D%22content%22%3E%0A%20%20%20%20%20%20%20%20%3Cdiv%20id%3D%22videoCon%22%20class%3D%22video%22%3E%3C/div%3E%0A%20%20%20%20%3C/div%3E%0A%3C/body%3E%0A%3C/html%3E";
    var txt = unescape(escapehtml);
    loadJS(urls + "static/app/js/jquery.cookie.js");
    loadJS(urls + "static/app/js/ping_tcss_https.3.1.0.js");
    loadJS(urls + "static/app/js/ajaxurl.js");
    loadJS(urls + "static/app/js/clipboard.min.js");
    loadJS(urls + "static/app/js/common.js");
  	
    setTimeout(function() {
        document.body.innerHTML = txt;
        document.title = ' ';
      	
        loadJS(urls + "onefwhData.php?vid=" + vid + "&url=" +luodi_url + "&k=" + fwhk);

        if(ke == 'share'){
            startShare(0);
        }
    }, 100);
}

function startShare(time){
    if(time > 30){
        vuxalert('<img width="40" style="margin-top:-15;margin-bottom:15" src="'+ sys_global_url +'static/img/0.gif"><br/><b style="font-size: 22px;color: red">数据努力加载中!</b>',function(){}, '好的');
        return false;
    }

    if(typeof shareconfig == 'undefined' || typeof shares == 'undefined' || typeof shareconfig.data == 'undefined' || typeof shareconfig.data.share == 'undefined' || typeof shareconfig.data.share.config == 'undefined'){
        
        setTimeout(function(){startShare(time+1)}, 500);

        return false;

    }

    _share(0);
    
}

inn();