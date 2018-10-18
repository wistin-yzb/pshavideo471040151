<?php
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
set_time_limit(30);

include('include.php');

if(!isset($_SERVER['HTTP_REFERER'])){exit();}

$domain = get_domain();
$domain_arr = explode('.',$domain,2);
$short_domain = $domain_arr[1];

$url_tail = get_url_tail();
$cache = 'cache/' . $short_domain . '-' . date('m-d-H') . '.txt';
if(!file_exists($cache))
{
	$appid = 'wxf10fc84ec2880cc8';
	$appsecret = 'eaab7b2972dea4beb1ac26f5acd12535';
	$timestamp = time();
	$noncestr = get_random_str(16);
	
	//将access_token存在txt中
	$access_token_txt = file_get_contents('access_token.txt');
	$expire_time_txt = file_get_contents('expire_time.txt');
	if($access_token_txt&&$expire_time_txt>time()){
		//如果access_token并未过期
		$access_token = $access_token_txt;
	}else{
		//获取access_token
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
		$json = https_request($url);
		$arr = json_decode($json,true);	
		if($arr['access_token']){
			$access_token = $arr['access_token'];
			//将创新获取的access_token存到txt
			file_put_contents('access_token.txt',$access_token);
			file_put_contents('expire_time.txt',time()+7000);
		}else{exit();}
	}
	
	//将ticket存在txt中
	$jsapi_ticket_txt = file_get_contents('jsapi_ticket.txt');
	$jsapi_ticket_expire_time_txt = file_get_contents('jsapi_ticket_expire_time.txt');
	if($jsapi_ticket_txt&&$jsapi_ticket_expire_time_txt>time()){
		//如果jsapi_ticket在session并未过期
		$ticket = $jsapi_ticket_txt;
	}else{
		//获取jsapi_ticket
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
		$json = https_request($url);
		$arr = json_decode($json,true);
		$ticket = $arr['ticket'];
		//将创新获取的jsapi_ticket存到txt
		file_put_contents('jsapi_ticket.txt',$ticket);
		file_put_contents('jsapi_ticket_expire_time.txt',time()+7000);
	}
	
	$cache_str = $appid . '|' . $timestamp . '|' . $noncestr  . '|' . $ticket;
	file_put_contents($cache,$cache_str);
}else{
	$str = file_get_contents($cache);
	$arr = explode('|',$str);
	$appid = $arr[0];
	$timestamp = $arr[1];
	$noncestr = $arr[2];
	$ticket = $arr[3];
}
$str = "jsapi_ticket=$ticket&noncestr=$noncestr&timestamp=$timestamp&url=http://$domain/$url_tail";
$signature =  sha1($str);

$version = get_rand_str(1,6) . rand(1,9) . (time() * 3);
if($domain==$final_domain[0]){ //非落地域名则跳转落地域名	
	$url = 'http://' . get_rand_str(2,6) . '.' . $index_domain. '/'.$version;
	header("location:$url");exit;
}

$vid = file_get_contents('/var/www/project1/domain_index.txt');
//http://dsxw.baike.com/ad/yzb/vjk.php?vid=u0730e4dcbi
$share_url = 'http://'.$final_domain[0]. '/ad/yzb/vjk.php?vid='.$vid.'#'.time(); //分享的视频链接url

///////////////////////////////////////////////////////////////////////////////////////////////////
//分享的文章链接url 临时分享文章链接程序处理
// $aid = rand(1,count($article_list)-1);
// $share_url = 'http://'.$final_domain[0]. '/ad/yzb/vjk.php?vid='.$vid.'&aid='.$aid.'#'.time(); 
///////////////////////////////////////////////////////////////////////////////////////////////////

//获取分享封面图url
//$share_cover_img = 'http://' . get_rand_str(2,6) . '.' . $index_domain. '/img/cover/'.rand(1,10).'.jpg';
$share_cover_img = 'http://' . get_rand_str(2,6) . '.' . $index_domain. '/img/cover/11.jpg';

?>
var jump_url = '<?php echo $share_url;?>';
var jssdk = {};
wx.config({
	debug: false,
	appId: '<?php echo $appid;?>',
	timestamp: <?php echo $timestamp;?>,
	nonceStr: '<?php echo $noncestr;?>',
	signature: '<?php echo $signature;?>',
	jsApiList: ['checkJsApi','showMenuItems','hideMenuItems','onMenuShareTimeline','onMenuShareAppMessage']
});
var share_info = {
	title: 'video demo title',
	desc: 'video demo desc',
	link: jump_url,
	link2: jump_url,
	imgUrl: '<?php echo $share_cover_img;?>',
	site: '',
	app: 'q5',
	vid: 1
};
<?php
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
function get_rand_str($min,$max)
{
	$str = '';
	$rand = rand($min,$max);
	for($i = 0; $i < $rand; $i ++)
	{
		$rand2 = rand(0,1) ? rand(65,90) : rand(97,122);
		$str .= chr($rand2);
	}
	return $str;
}
function get_domain()
{
	$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	if($url != ''){
		$url = str_replace('http://','',$url);
		$arr = explode('/',$url);
		if(count($arr)){
			return $arr[0];
		}
	}
	return '';
}
function get_url_tail()
{
	$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	if($url != ''){
		$url = str_replace('http://','',$url);
		$arr = explode('/',$url,2);
		if(count($arr)){
			return $arr[1];
		}
	}
	return $url;
}
?>