<?php 
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
set_time_limit(30);
include('../include.php');
$domain = $_SERVER['HTTP_HOST'];
if(!$domain){
	exit;
}
$domain_arr = explode('.',$domain,2);
$short_domain = $domain_arr[1];
$source = $_GET['source']?$_GET['source']:'index';

/////////////////////////////////////////////////////
//临时跳转到指定访问网页程序处理
$artice_id = $_GET['aid'];
if($artice_id>0){
	$url = $article_list[$artice_id];
	header("location:$url");exit();
}
/////////////////////////////////////////////////////
if($domain == $final_domain[0]){  //非落地域名则跳转落地域名
	$version = get_rand_str(1,6) . rand(1,9) . (time() * 3);
	$url = 'http://' . $domain_arr[0]. '.' . $index_domain. '/' .$version.'?vid='.$_REQUEST['vid'].'&source=freindline';
	header("location:$url");exit;
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
?>