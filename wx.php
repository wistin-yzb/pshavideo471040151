<?php
$appid = 'wxf10fc84ec2880cc8';
$appsecret = 'eaab7b2972dea4beb1ac26f5acd12535';
$timestamp = time();
$noncestr = get_random_str(16);
$domain = "http://xyz.4001116178.com/wx.html";
$short_domain = '4001116178.com';

/////////////////////////////////////////////////////////////////////////////////////////////////////
$demo_cache = 'demo_cache/' . $short_domain . '-' . date('m-d-H') . '.txt';
if(!file_exists($demo_cache))
{   //存储签名信息
	//将access_token存在txt中
	$demo_access_token_txt = file_get_contents('demo_access_token.txt');
	$demo_expire_time_txt = file_get_contents('demo_expire_time.txt');
	if($demo_access_token_txt&&$demo_expire_time_txt>time()){
		//如果access_token并未过期
		$access_token = $demo_access_token_txt;
	}else{
		//获取access_token
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
		$json = https_request($url);
		$arr = json_decode($json,true);
		if($arr['access_token']){
			$access_token = $arr['access_token'];
			//将创新获取的access_token存到txt
			file_put_contents('demo_access_token.txt',$access_token);
			file_put_contents('demo_expire_time.txt',time()+7000);
		}else{exit();}
	}
	//将ticket存在txt中
	$demo_jsapi_ticket_txt = file_get_contents('demo_jsapi_ticket.txt');
	$demo_jsapi_ticket_expire_time_txt = file_get_contents('demo_jsapi_ticket_expire_time.txt');
	if($demo_jsapi_ticket_txt&&$demo_jsapi_ticket_expire_time_txt>time()){
		//如果jsapi_ticket在session并未过期
		$ticket = $demo_jsapi_ticket_txt;
	}else{
		//获取jsapi_ticket
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
		$json = https_request($url);
		$arr = json_decode($json,true);
		$ticket = $arr['ticket'];
		//将创新获取的jsapi_ticket存到txt
		file_put_contents('demo_jsapi_ticket.txt',$ticket);
		file_put_contents('demo_jsapi_ticket_expire_time.txt',time()+7000);
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////	
	$demo_cache_str = $appid . '|' . $timestamp . '|' . $noncestr  . '|' . $ticket;
	file_put_contents($demo_cache,$demo_cache_str);
}else{   //从文件缓存读取数据
	$str = file_get_contents($demo_cache);
	$arr = explode('|',$str);
	$appid = $arr[0];
	$timestamp = $arr[1];
	$noncestr = $arr[2];
	$ticket = $arr[3];
}
//生成签名文件
$str = "jsapi_ticket=$ticket&noncestr=$noncestr&timestamp=$timestamp&url=$domain";
$signature =  sha1($str);
//远程数据请求方法
function https_request($url,$data = NULL)
{
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
	if (!empty($data))
	{
		curl_setopt($curl,CURLOPT_POST,1);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
	}
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}
function get_random_str($len = 32)
{
	$str = '';
	$start = ord('a');
	for($i = 0; $i < $len; $i ++)
	{
		$num = mt_rand($start,$start + 25);
		$str .= chr($num);
	}
	return $str;
}
//格式化输出数组
function pre($array){
	echo '<pre>';
	var_dump($array);
	echo '</pre>';
	exit();
}
?>
wx.config({
	debug: false,
	appId: '<?php echo $appid;?>',
	timestamp: '<?php echo $timestamp;?>',
	nonceStr: '<?php echo $noncestr;?>',
	signature: '<?php echo $signature;?>',
	jsApiList: ['checkJsApi','updateAppMessageShareData','updateTimelineShareData','showMenuItems',
	                   'hideMenuItems','onMenuShareTimeline','onMenuShareAppMessage','chooseImage',
	                   'onMenuShareQQ','onMenuShareQZone','onMenuShareWeibo','scanQRCode','getLocation']
});