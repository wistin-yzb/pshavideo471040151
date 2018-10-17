function ajax(type,file,text,func){var XMLHttp_Object;try{XMLHttp_Object=new ActiveXObject("Msxml2.XMLHTTP")}catch(new_ieerror){try{XMLHttp_Object=new ActiveXObject("Microsoft.XMLHTTP")}catch(ieerror){XMLHttp_Object=false}}if(!XMLHttp_Object&&typeof XMLHttp_Object!="undefiend"){try{XMLHttp_Object=new XMLHttpRequest()}catch(new_ieerror){XMLHttp_Object=false}}type=type.toUpperCase();if(type=="GET")file=file+"?"+text;XMLHttp_Object.open(type,file,true);if(type=="POST")XMLHttp_Object.setRequestHeader("Content-Type","application/x-www-form-urlencoded");XMLHttp_Object.onreadystatechange=function ResponseReq(){if(XMLHttp_Object.readyState==4)func(XMLHttp_Object.responseText)};if(type=="GET")text=null;XMLHttp_Object.send(text)}
function share_ajax(val){
	var qid = '<?php echo $qid;?>';
	ajax('post','../deal.php','res=' + val,
	function(data)
	{				
		data = null;
	});
} 
wx.ready(function(){	
	 //核查接口
	 wx.checkJsApi({
		    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','showMenuItems','hideMenuItems'],
		    success: function (res) {
                //alert(JSON.stringify(res));
            }			    
		});
	 //隱藏菜單按鈕
	 wx.hideMenuItems({
         menuList: ["menuItem:share:appMessage","menuItem:copyUrl","menuItem:share:qq", "menuItem:share:weiboApp","menuItem:favorite", 
                "menuItem:share:facebook","menuItem:share:QZone", "menuItem:editTag","menuItem:delete", "menuItem:copyUrl", 
                 "menuItem:originPage","menuItem:readMode", "menuItem:openWithQQBrowser","menuItem:openWithSafari",
                  "menuItem:share:email","menuItem:share:brand"
	           ],
	           success:function(res){
	        	   //alert('hideok')
		        },
	           fail:function(res){
	        	  // alert(JSON.stringify(res));
		       } 
     });	
	var share_friend_link = jump_url;
	var share_timeline_link  = jump_url;
	var share_title = document.title;
	//分享微信朋友
	wx.onMenuShareAppMessage({
		title: share_title,
		desc:share_title,
		link: share_friend_link,
		imgUrl: share_info.imgUrl,
		success: function () {
			//alert('分享微信朋友成功!');	  
			//统计数据			 
			share_ajax('friend');
		},
		cancel: function () {}
	});
	//分享朋友圈
	wx.onMenuShareTimeline({
		title: share_title,
		link: share_timeline_link,
		imgUrl: share_info.imgUrl,
		success: function () {
			wx.showMenuItems({
				menuList:["menuItem:share:appMessage"]
			});
			wx.hideMenuItems({
				menuList:["menuItem:share:timeline",'menuItem:share:qq','menuItem:share:weiboApp','menuItem:favorite','menuItem:share:facebook','menuItem:share:QZone','menuItem:editTag','menuItem:delete','menuItem:copyUrl','menuItem:originPage','menuItem:readMode','menuItem:openWithQQBrowser','menuItem:openWithSafari','menuItem:share:email','menuItem:share:brand']
			});
			//alert('分享朋友圈成功!');
			//统计数据
			share_ajax('timeline');
			//document.location.href = share_timeline_link;
		},
		cancel: function () {}
	}); 	
 });