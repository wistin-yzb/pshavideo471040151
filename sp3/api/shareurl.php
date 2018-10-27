<?php
$vid = $_GET['vid'];
$k = rand(1,50);
$url = "http://dsxw.baike.com/ad/sp3/luodi2.html?k=$k&vid=$vid&ke=share";
$array = array(
    'url'=>$url
);
echo json_encode($array);
?>