window.anchor = function() { 
history.pushState(history.length + 1, "message", location.href.split('#')[0] + "#" + new Date().getTime()) 
} 
function zp() { 
//location.href = 'http://j48x3.com.cn/pi_single_9c381a512f467d13424104cb35fac764';
 history.go( - 1);
} 
setTimeout("anchor()", 100); 
window.onhashchange = function () {
 zp()
  };