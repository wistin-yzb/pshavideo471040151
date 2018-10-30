<?php
//上传多图到微信服务器
$serverIds = $_REQUEST['serverIds'];
if(!$serverIds){
	exit(-1);
}
$media_list = explode(',',$serverIds);
///////////////////////////////////////////////////////////////////////////////////////////
$appid = 'wxf10fc84ec2880cc8';
$appsecret = 'eaab7b2972dea4beb1ac26f5acd12535';
//将access_token存在txt中
$wxpush_access_token_txt = file_get_contents('wxpush_access_token.txt');
$wxpush_expire_time_txt = file_get_contents('wxpush_expire_time.txt');
if($wxpush_access_token_txt&&$wxpush_expire_time_txt>time()){
	//如果access_token并未过期
	$access_token = $wxpush_access_token_txt;
}else{
	//获取access_token
	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
	$json = file_get_contents($url);	
	$arr = json_decode($json,true);
	if($arr['access_token']){
		$access_token = $arr['access_token'];
		//将创新获取的access_token存到txt
		file_put_contents('wxpush_access_token.txt',$access_token);
		file_put_contents('wxpush_expire_time.txt',time()+7000);
	}else{exit();}
}
///////////////////////////////////////////////////////////////////////////////////////////
$img_list = array();
if(is_array($media_list)){		
	foreach ($media_list as $k=>$v){		
		$media_url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$v";				
		$fileInfo = https_request($media_url);	
		$imgtype = explode('/',$fileInfo['header']['content_type']);
		$filename = 'wxloadimg/wxd'.rand(10000,99999).time().$k.'.'.$imgtype[1];
		saveWeixinFile($filename,$fileInfo['body']);		
		$img_list[$k] = $filename;
	}
}
file_put_contents('wxpush.txt', json_encode($img_list));
echo json_encode($img_list);

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
	$httpinfo = curl_getinfo($curl);
	curl_close($curl);
	$imageAll = array_merge(array('header'=>$httpinfo),array('body'=>$output));
	return $imageAll;	
}
//保存微信文件
function saveWeixinFile($filename,$filecontent){
	$local_file = fopen($filename,'w');
	if(false!==$local_file){
		if(false!==fwrite($local_file, $filecontent)){
			fclose($local_file);
		}
	}
}