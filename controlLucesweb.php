<?php
  $devId=$_GET["luz"];
  $state=$_GET["state"];
  //session_write_close(); 
  
  $url_host='http://192.168.2.129:9000';

    
  if ($state=='read'){
    $url=$url_host.'/Device/Read?devId='.$devId;
  } elseif ($state=='readMode'){
    ///TimerOnOff/Read?devId=SOJD1
    $url=$url_host.'/TimerOnOff/Read?devId='.$devId;  
  } elseif ($state=='switchModeProg'){
    ///TimerOnOff/Setmode?devId=SOJD1&Mode=Prog
    $url=$url_host.'/TimerOnOff/Setmode?devId='.$devId.'&Mode=Prog';  
  } elseif ($state=='switchModeMan'){
    ///TimerOnOff/Setmode?devId=SOJD1&Mode=Man
    $url=$url_host.'/TimerOnOff/Setmode?devId='.$devId.'&Mode=Man';  
  } else {
    $url=$url_host.'/Device/Actuate?devId='.$devId.'&State='.$state;
  }
    
  $ch=curl_init();
  $timeout=1;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $result=curl_exec($ch);
  curl_close($ch);
  
  echo $result;
?>
