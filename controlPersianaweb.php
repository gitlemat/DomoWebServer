<?php
  $persiana=$_GET["persiana"];
  $nivel=$_GET["nivel"];
  
  $url_host='http://192.168.2.129:9000';
  $url=$url_host.'/Update/Persianas/'.$persiana.'/'.$nivel.'/';

  $ch=curl_init();
  $timeout=5;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $result=curl_exec($ch);
  curl_close($ch);
?>
